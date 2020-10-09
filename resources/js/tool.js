Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'nova-robots-editor',
      path: '/nova-robots-editor',
      component: require('./components/Tool'),
    },
  ])
})
