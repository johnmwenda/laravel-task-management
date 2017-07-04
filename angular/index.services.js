import { ContextService } from './services/context.service'
import { APIService } from './services/API.service'
import { userService } from './services/userService'


angular.module('app.services')
  .service('ContextService', ContextService)
  .service('API', APIService)  
  .service('userService', userService)

