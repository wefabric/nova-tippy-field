<template>
    <span v-if="tipContent"
          :id="'nova-simple-tooltip' + id "
          class="nova-simple-tooltip cursor-pointer items-center flex justify-center text-90 hover:text-primary"
          ref="tooltip">
        <span class="whitespace-no-wrap" v-if="text && !iconUrl">{{ text }}</span>
        <span class="mr-2" v-if=" text && iconUrl && iconPosition === 'right'">{{ text }}</span>
        <img v-if="iconUrl" :width="iconSize" :src="iconUrl" alt="Image description." />
        <span class="inline-flex text-70" v-if="iconPath" v-html="iconPath"></span>
        <span class="ml-2 " v-if=" text && iconUrl && iconPosition === 'left'">{{text}}</span>
    </span>
</template>

<script>
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

export default {

    props: ['value', 'iconPath', 'iconUrl', 'iconSize', 'text', 'iconPosition', 'tipContent', 'id', 'placement', 'tippyOptions'],

    mounted() {
        if(this.tipContent) {
            tippy('#nova-simple-tooltip' + this.id, {
                content: this.tipContent,
                placement: this.placement,
                ...this.tippyOptions
            });
        }
    }

}
</script>

