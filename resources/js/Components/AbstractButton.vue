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
            default: 'submit',
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
