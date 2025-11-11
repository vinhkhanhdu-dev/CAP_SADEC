<template>
    <div>
        <lottie-animation
            ref="anim"
            :animationData="require('./36395-lonely-404.json')"
            />
    </div>
</template>
<script>

import LottieAnimation from 'lottie-web-vue'
export default {
  components: {
      LottieAnimation
  },
}
</script>
