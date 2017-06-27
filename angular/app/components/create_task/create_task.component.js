class CreateTaskController{
    constructor(userService){
        'ngInject';
        this.userService = userService;

        //
    }

    $onInit(){
        this.userService.getTaskCategories().then(function(resp){
            console.log(resp);
        }, function(error){
            console.log(error);
        })
    }
}

export const CreateTaskComponent = {
    templateUrl: './views/app/components/create_task/create_task.component.html',
    controller: CreateTaskController,
    controllerAs: 'vm',
    bindings: {}
};
