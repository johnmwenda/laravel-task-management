class TaskController{
    constructor(userService, $stateParams){
        'ngInject';
        this.userService = userService;
        this.$stateParams = $stateParams;
        
        let vm = this;

        //
    }

    $onInit(){
        let vm = this;


        vm.taskid = this.$stateParams.id;
    }
}

export const TaskComponent = {
    templateUrl: './views/app/components/task/task.component.html',
    controller: TaskController,
    controllerAs: 'vm',
    bindings: {}
};
