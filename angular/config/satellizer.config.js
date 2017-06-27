export function SatellizerConfig ($authProvider) {
  'ngInject'

  $authProvider.httpInterceptor = function () {
    return true
  }

  $authProvider.loginUrl = 'http://localhost:8001/api/users/login'
  $authProvider.signupUrl = 'http://localhost:8001/api/auth/register'
  $authProvider.tokenRoot = 'data' // compensates success response macro
  $authProvider.tokenHeader = 'Authorization'
  $authProvider.tokenType = 'Token'
}

// /#/login