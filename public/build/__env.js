/**
 * Assign __env to the root window object.
 *
 * The goal of this file is to allow the deployment
 * process to pass in environment values into the application.
 *
 * The deployment process can overwrite this file to pass in
 * custom values:
 *
 * window.__env = window.__env || {};
 * window.__env.url = 'some-url';
 * window.__env.key = 'some-key';
 *
 * Keep the structure flat (one level of properties only) so
 * the deployment process can easily map environment keys to
 * properties.
 */

(function (window) {


  window.__env = window.__env || {};
  // console.log(window.__env);
  var environment = 'PRODUCTION';    

  window.__env.debug = false; 

  if(environment == 'PRODUCTION') {
    productionEnvironment();
  }else {
    localEnvironment();
  }


function localEnvironment() {
    //SET app to local
    window.__env.environment = 'LOCAL';
    window.__env.baseUrl = 'http://cytonn.local.app/api/';
  }


function productionEnvironment() {
  window.__env.environment = 'PRODUCTION';
  window.__env.baseUrl = 'https://cytonn-web-app.herokuapp.com/api/';

}

}(this));