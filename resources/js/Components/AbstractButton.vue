<script>
import { router } from '@inertiajs/vue3'

export default {
    props: {
        link: {
            type: String,
            default: null
        },
        type: {
            type: String,
            default: 'button',
        },
    },
    methods: {
        openLink() {
            if(this.link !== null) {
                router.visit(this.link);
            }
        }
    }
}
</script>
