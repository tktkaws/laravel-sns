<template>
  <div>
    <button type="button" class="btn m-0 p-1 shadow-none">
      <i
        class="fas fa-heart mr-1"
        #----------ここから追加----------
        :class="{'red-text':this.isLikedBy}"
        #----------ここまで追加----------
      />
    </button>
    10
  </div>
</template>

<script>
//==========ここから追加==========
export default {
  props: {
    initialIsLikedBy: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      isLikedBy: this.initialIsLikedBy
    };
  }
};
//==========ここまで追加==========
</script>
