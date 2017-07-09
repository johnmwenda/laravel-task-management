ShowLoader.$inject = ['$loading', '$rootScope']
//jquery loader directive
//jquery loader directive

//this directive is used on a button...when its clicked we traverse to class with panel body
//get the attribute inside dw-loading 
function ShowLoader($loading, $rootScope){
    
    return {
      restrict: 'A',
      link: function(scope, element, attrs) {
      // console.log('showLoader is working');
            scope.collapsing = false;
            var jqElement = $( element) ;
          // console.log('loaderKey',scope.loaderKey);
          // console.log('isTrue',scope.isTrue);
          // console.log('attrs', attrs);
         
          scope.$watch('isTrue',  function(value){
            // console.log(value);
            if(value === true){
              $loading.start(scope.loaderKey);
              $rootScope.currentLoadingKey = scope.loaderKey
              // console.log($rootScope.currentLoadingKey)
            } 
            else{
              $loading.finish(scope.loaderKey);
            }
          });

        }
      ,
    scope: {
      loaderKey: '=loaderKey',
      isTrue: '=isTrue' 
    }

    }
}

export const ShowLoaderDirective = ShowLoader;
