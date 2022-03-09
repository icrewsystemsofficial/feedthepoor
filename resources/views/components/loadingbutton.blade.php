
<script>
    function loadingButton() {
        return {
            loading: false,
            disabled: false,

            clicked() {
                if(this.loading == false) {
                    this.loading = true;
                    this.disabled = true;
                } else {
                    this.loading = false;
                    this.disabled = false;
                }


                setTimeout(() => {
                    this.clicked();
                }, 10000);
            }
        }
    }
</script>

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }} x-bind:disabled="disabled" x-data="loadingButton()" @click="clicked"  x-cloak>
    <span x-show="loading">
        <i class="fa-solid fa-spinner fa-spin"></i>
        &nbsp;
    </span>
    {{ $slot }}
</button>
