var routes = [
  // Index page
  {
    path: '/',
    componentUrl:'/v2/pages/home',
    name: 'index',
    master(f7) {
      return f7.theme === 'aurora';
    },
  },
  {
    path:'/v2/mob',
    componentUrl: '/v2/pages/home',
    name: 'home2'
  },
  {
    path:'/v2/mob/staffmatching/:code',
    componentUrl: '/v2/pages/staff-matching.html?code={{code}}',
    name: 'staffmatching',
  },

  {
    path:'/v2/mob/board/:code',
    componentUrl: '/v2/pages/board.html?code={{code}}',
    name: 'boardlist',
    options: {
      transition: 'f7-flip',
    },
  },
  {
    path:'/v2/mob/board/:code/:id',
    componentUrl: '/v2/pages/board/view/{{code}}/{{id}}',
    name: 'boardview',
    options: {
      transition: 'f7-circle',
    },
  },

  {
    path:'/v2/mob/myrequest',
    async: function ({ app, to, resolve }) {
      // Get external data and return page content
      app.request.json('/v2/pages/checkphone').then(function (res) {
        console.log ( res )
        resolve(
          // How and what to load
          {
            content: `<div class="page">123</div>`
          },
        );
      }).catch(function(err){
        resolve({
          componentUrl: '/v2/pages/checkphonescreen.html'
        });
      });
    }

  },

  //event test
  {
    path:'/v2/mob/event/:code',
    url:'/v2/pages/event/{{code}}.html',
    name:'event',
    options: {
      transition: 'f7-circle',
    },
  },
  // review
  {
    path:'/v2/mob/popup/review/:id',
    popup:{
      componentUrl: '/v2/pages/review/{{id}}',
    },
  },

  // About page
  {
    path: '/about/',
    url: '/v2/assets/framekit/kitchen-sink/core/pages/about.html',
    name: 'about',
  },
  // About page
  {
    path: '/righttest/',
    url: '/v2/pages/righttest.html',
    name: 'righttest',
  },

  //약관테스트
  {
    path:'/v2/mob/common/:code',
    popup: {
      url:'/v2/pages/common/{{code}}.html',
    }
  },
  // Right Panel pages
  {
    path: '/panel-right-1/',
    content: `
      <div class="page">
        <div class="navbar">
          <div class="navbar-bg"></div>
          <div class="navbar-inner sliding">
            <div class="left">
              <a href="#" class="link back">
                <i class="icon icon-back"></i>
                <span class="if-not-md">Back</span>
              </a>
            </div>
            <div class="title">Panel Page 1</div>
          </div>
        </div>
        <div class="page-content">
          <div class="block">
            <p>This is a right panel page 1</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo saepe aspernatur inventore dolorum voluptates consequatur tempore ipsum! Quia, incidunt, aliquam sit veritatis nisi aliquid porro similique ipsa mollitia eaque ex!</p>
          </div>
        </div>
      </div>
    `,
  },
  {
    path: '/panel-right-2/',
    content: `
      <div class="page">
        <div class="navbar">
          <div class="navbar-bg"></div>
          <div class="navbar-inner sliding">
            <div class="left">
              <a href="#" class="link back">
                <i class="icon icon-back"></i>
                <span class="if-not-md">Back</span>
              </a>
            </div>
            <div class="title">Panel Page 2</div>
          </div>
        </div>
        <div class="page-content">
          <div class="block">
            <p>This is a right panel page 2</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo saepe aspernatur inventore dolorum voluptates consequatur tempore ipsum! Quia, incidunt, aliquam sit veritatis nisi aliquid porro similique ipsa mollitia eaque ex!</p>
          </div>
        </div>
      </div>
    `,
  },



  {
    path: '(.*)',
    url: '/v2/pages/404.html',
  },
]
