import router from  './../../router'
import Example from './pages/Example'

router.addRoutes([
    {
        path: '/example',
        name: 'example',
        component: Example
    }
])
