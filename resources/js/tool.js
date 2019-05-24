
//When create resource via relationship go to the parent details instead of the create child details
Nova.booting((Vue, router, store) => {

    router.beforeEach((to, from, next) => {
        if ((from.name === 'create' || from.name === 'edit') &&
            from.query.viaRelationship !== '' &&
            to.name === 'detail' &&
            to.params.resourceName !== from.query.viaResource &&
            from.query.viaResource === 'plans') {

            let newTo = {
                name : 'detail',
                params: {
                    resourceName: from.query.viaResource,
                    resourceId: from.query.viaResourceId,
                }
            }
            next(newTo)
        }
        next()
    })

    // router.addRoutes([
    //     {
    //         name: 'plans',
    //         path: '/plans',
    //         component: require('./components/Tool'),
    //     },
    // ])
})
