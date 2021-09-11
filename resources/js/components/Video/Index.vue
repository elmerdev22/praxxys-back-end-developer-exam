<template>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-9 mb-2">
                    <video-player v-if="renderComponent" :url="videoLists[selectedVideo].url" :controls="true" :autoplay="true" />
                    <h5 class="mt-2">{{videoLists[selectedVideo].name}}</h5>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div v-for="video, index in videoLists" :key="index" class="col-12 mb-2 border p-1">
                            <div style="cursor: pointer;" v-on:click="changeUrl(index)" >
                                <video-player :url="video.url" :controls="video.controls" :autoplay="video.autoplay" />
                                <div>{{video.name}} <span v-if="selectedVideo == index"><small>(Selected)</small></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    
    import VideoPlayer from "../Video/Player.vue";

    const Player = {
        name: "Video",
        components: {
            VideoPlayer
        },
        data() {
            return {
                selectedVideo  : 0,
                renderComponent: true,
                videoLists     : [
                    {
                        url     : "http://127.0.0.1:8000/videos/video1.mp4",
                        name    : 'Video 1',
                        autoplay: false,
                        controls: false
                    },
                    {
                        url     : "http://127.0.0.1:8000/videos/video2.mp4",
                        name    : 'Video 2',
                        autoplay: false,
                        controls: false
                    },
                    {
                        url     : "http://127.0.0.1:8000/videos/video3.mp4",
                        name    : 'Video 3',
                        autoplay: false,
                        controls: false
                    },
                ],
            };
        },
        methods : {
            changeUrl(index){
                this.selectedVideo   = index
                this.renderComponent = false;
                this.$nextTick(() => {
                    this.renderComponent = true;
                });
            }
        }
    }

    export default Player;
</script>
