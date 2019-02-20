var app = new Vue({
  el: "#app",
  data: {
    msg: "hello world!",
    users: null,
  },
  methods: {
    getUserData: function () {
      axios.get('baza_mammarzenie.json')
        .then(response => {
          this.users = response.data;
          this.users.forEach(element => {
            //console.log(response.data);
          });
         
          setTimeout(function () {
            $("#dreamers-owl").owlCarousel({
              loop: true,
              margin: 15,
              autoplay: true,
            responsive:{
                0: {
                  items: 1
                },
                768:{
                  items:2
                },
                900: {
                  items: 3
                }
            }
            });
           
          }, 0);

        });
    },
    showUsers: function () {
    },
    passUser: function (user) {
      app2.currentUser = user;
      setTimeout(() => {
      

      }, 0);
      
    }
  },
  created: function () {
    this.getUserData();
  }
});

var app2 = new Vue({
  el: '#app2',
  data: {
    currentUser: {
      avatar: null,
      description: null,
      gallery: [],
      link: null,
      name: null,
      sponsor: null,
      titleName: null,
      wish: null,
      wishday: null
    }
  },
  methods: {
    showUsers: function () {
      console.log(this.users);
    }
  }
});

var app3 = new Vue({
  el:'#app3',
  data:{
    errors:[],
    user:{
      name: null,
      email: null,
      msg: null
    },
    success: false

  },
  methods:{
       checkForm: function (e) {
          this.errors = [];
          if (!this.user.name) this.errors.push("Podpis wymagany.");
          if (!this.user.email) {
            this.errors.push("Email wymagany.");
          } else if (!this.validEmail(this.user.email)) {
            this.errors.push("Nieprawidłowy adres Email.");
          }
          if (!this.errors.length){
          
            this.sendData();
          }

       },
       validEmail: function (email) {
         var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         return re.test(email);
       },
       sendData: function(){
         
        axios({
          url: "formData.php",
          method: "POST",
          contentType: "application/json",
          dataType: 'json',
          data:{
            name: this.user.name,
            email: this.user.email,
            msg: this.user.msg
          }

        })
        .then(res => {
          this.success = true;
       });
  }
}})