export function SatellizerConfig ($authProvider) {
  'ngInject'

  $authProvider.httpInterceptor = function () {
    return true
  }

  $authProvider.loginUrl = window.__env.baseUrl+'users/login'
  $authProvider.signupUrl = window.__env.baseUrl+'auth/register'
  $authProvider.tokenRoot = 'data' // compensates success response macro
  $authProvider.tokenHeader = 'Authorization'
  $authProvider.authToken = 'Token'
}

// /#/login