class TasksController{
    constructor(userService, $stateParams){
        'ngInject';
        this.$stateParams = $stateParams;
        this.userService = userService;
        //
    }

    $onInit(){
        let vm = this;
        this.loadingFilter = true;
        // console.log(tasks);
        // console.log(this.$stateParams.filter);
        this.current_filter = this.$stateParams.filter || 'all';
        this.current_filter_name = 'All Tasks';

        this.userService.getMyTasks(this.current_filter).then(function(resp){
            // console.log(resp);
            vm.loadingFilter = false;

            vm.tasks = resp.data.tasks; 
        }, function(error){ 
            // console.log(error);
            vm.loadingFilter = false;
        })
    }

    changeFilter(filter) {
        let vm = this;
        vm.tasks = []; 
        vm.loadingFilter = true;

        vm.current_filter = filter; 
        let obj = {
            "all": "All Tasks",
            "reported_by_me": "Reported by me",
            "assigned_to_me": "Assigned to me",
            "private_tasks": "Private tasks",
            "public_tasks": "Public tasks",
            "following": "Tasks that I am following"
            }
        vm.current_filter_name = obj[filter];

        // vm.userService.getMyTasks(vm.current_filter).then(function(resp){
        //     // console.log(resp);
        //     vm.loadingFilter = false;

        //     vm.tasks = resp.data.tasks;

        // }, function(error){
        //     // console.log(error);
        //     vm.loadingFilter = false;
        // });
    }
}

export const TasksComponent = {
    templateUrl: './views/app/components/tasks/tasks.component.html',
    controller: TasksController,
    controllerAs: 'vm',
    bindings: {
    }
};
