<template>
	<div style="display: flex; justify-content: center; align-items: center; height: 100%;">
        <p style="text-align: right; font-size: 1rem; color: #a0aec0; border-right: 1px solid #cbd5e0; padding-right: 10px; margin-bottom: 0;">
            App Debug
        </p>
        <p style="text-aling: left; font-size: 1rem; color: #a0aec0; padding-left: 10px; margin-bottom: 0;">
            {{$store.getters.getAppDebugData.message}}
        </p>
    </div>
</template>

<script>
	import { onMounted, onUnmounted } from 'vue';
  	import { useStore } from 'vuex';
  	export default{
    	setup(){
      		const store = useStore()
      		onMounted(
		        async() => {
		          	document.getElementById('body').className = 'antialiased'
		        }
      		)
		    onUnmounted(
		        async() => {
		        	store.dispatch('removeServerError')
		        	store.dispatch('removeAppDebugData')
		          	document.getElementById('body').className = 'main'
		        }
		    )
    	}
  	}
</script>

<style>
	html{
		height: 100%;
	}
    body{
        height: 100%;
    }
    #app{
    	height: 100%;
    }
</style>