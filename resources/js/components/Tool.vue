<template>
  <div>
    <heading class="mb-6">
      Robots.txt Editor
    </heading>
    <textarea
      v-model="contents"
      class="w-full form-control form-input form-input-bordered py-3 h-64 my-3"
      style="min-height: 60vh"
    />
	<p v-if="updatedAt" class="mb-1">Last updated: {{ updatedAt }}</p>
    <button
      type="button"
      class="btn btn-default btn-primary inline-flex items-center relative mr-3"
      :class="{'opacity-50 cursor-not-allowed': btnDisabled || !contentsDiff}"
      :disabled="btnDisabled || !contentsDiff"
      @click.prevent="submit"
    >
      {{ btnText }}
    </button>
  </div>
</template>

<script>
export default {
	data () {
		return {
			contents: '',
			originalContents: '',
			btnText: 'Save',
			btnDisabled: false,
			updatedAt: null,
		};
	},
	computed: {
		contentsDiff () {
			return this.contents !== this.originalContents;
		},
	},
	mounted() {
		this.btnText = 'Loading...';
		this.btnDisabled = true;
		window.Nova.request().get('/nova-vendor/nova-robots-editor/robots-file').then(res => {
			this.originalContents = res.data.contents;
			this.contents = res.data.contents;
			this.updatedAt = res.data.updated_at;
			this.btnText = 'Save';
			this.btnDisabled = false;
		})
	},

	methods: {
		submit () {
			const confirm = window.confirm('Are you sure you want to save and override the existing robots.txt?');
			if (!confirm) {
				return;
			}
			this.btnText = 'Saving...';
			this.btnDisabled = true;
			window.Nova.request().post('/nova-vendor/nova-robots-editor/robots-file', {contents: this.contents}).then(res => {
				this.originalContents = res.data.contents;
				this.contents = res.data.contents;
				this.updatedAt = res.data.updated_at;
				this.btnText = 'Saved';
				this.btnDisabled = false;
				window.setTimeout(() => {this.btnText = 'Save'}, 4000);
			})
		},
	},
}
</script>

<style>
/* Scoped Styles */
</style>
