var MyComponent = {
    template: '<p class="my-comp">{{ myName }}のコンポーネント</p>',
    props: {
     myName: String
    }
   }
       
   Vue.createApp({
    data() {
     return {
      myArray:['1つ目','2つ目','3つ目','4つ目','argaega']
     }
    },
    components: {
     'my-component': MyComponent
    }
   }).mount("#app");