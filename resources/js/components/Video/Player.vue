<template>
    <div>
        <video ref="videoPlayer" class="video-js"></video>
    </div>
</template>
<script>

    import videojs from 'video.js';

    const Player = {
        name: "VideoPlayer",
        props:[
            'url',
            'autoplay',
            'controls'
        ],
        data() {
            return {
                player: null
            }
        },
        mounted() {
            this.player = videojs(this.$refs['videoPlayer'], {
                    autoplay: this.autoplay,
                    controls: this.controls,
                    sources: [
                        {
                            src : this.url,
                            type: "video/mp4"
                        }
                    ],
                    fluid : true
                }, function onPlayerReady() {
                console.log('onPlayerReady', this);
            })
        },
        beforeDestroy() {
            if (this.player) {
                this.player.dispose()
            }
        },
        methods : {
            forceRerender() {
                this.renderComponent = false;
                this.$nextTick(() => {
                this.renderComponent = true;
                });
            }
        }
    }

    export default Player;
</script>
