export function SatellizerConfig ($authProvider) {
  'ngInject'

  $authProvider.httpInterceptor = function () {
    return true
  }

  $authProvider.loginUrl = 'http://cytonn.local.app/api/users/login'
  $authProvider.signupUrl = 'http://cytonn.local.app/api/auth/register'
  $authProvider.tokenRoot = 'data' // compensates success response macro
  $authProvider.tokenHeader = 'Authorization'
  $authProvider.authToken = 'Token'
}

// /#/login