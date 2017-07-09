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

        this.userService.getTasks(this.current_filter).then(function(resp){
            // console.log(resp);
            vm.loadingFilter = false;
        }, function(error){
            // console.log(error);
            vm.loadingFilter = false;
        })
    }

    changeFilter(filter) {
        let vm = this;
        this.loadingFilter = true;

        this.current_filter = filter; 
        let obj = {
            "all": "All Tasks",
            "reported-by-me": "Reported by me",
            "assigned-to-me": "Assigned to me",
            "private-tasks": "Private tasks",
            "public-tasks": "Public tasks",
            "following": "Tasks that I am following"
            }
        this.current_filter_name = obj[filter];

        this.userService.getTasks(this.current_filter).then(function(resp){
            // console.log(resp);
            vm.loadingFilter = false;
        }, function(error){
            // console.log(error);
            vm.loadingFilter = false;
        })
    }
}

export const TasksComponent = {
    templateUrl: './views/app/components/tasks/tasks.component.html',
    controller: TasksController,
    controllerAs: 'vm',
    bindings: {
    }
};
