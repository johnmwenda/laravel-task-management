class DepartmentTasksController{
    constructor($stateParams, ContextService, userService){
        'ngInject';
        let vm = this;
        this.$stateParams = $stateParams;
        this.userService = userService;

        ContextService.me(function (data) {
            console.log(data);
            vm.userData = data;
            vm.current_department = vm.userData.department
            vm.loadingFilter = true;
            vm.getInitialDepartmentTasks();
        })
    }

    $onInit(){
         let vm = this;

         this.userService.getAllDepartments().then(function(resp){
            // console.log(resp);
            vm.departments = resp.data;
         }, function(error){
            // console.log(error);
         })
        
    }

    getInitialDepartmentTasks() {
        let vm = this;

        // console.log(this.current_filter);



        vm.userService.getDepartmentTasks(vm.userData.department.id).then(function(resp){
            // console.log(resp);
            vm.loadingFilter = false;

            vm.tasks = resp.data.tasks; 
        }, function(error){ 
            // console.log(error);
            vm.loadingFilter = false;
        })
    }

    changeFilter(department) {
        let vm = this;

        vm.current_department = department

        vm.tasks = []; 
        this.loadingFilter = true;

        this.dep_id = vm.current_department.id;

        this.userService.getMyTasks(this.dep_id).then(function(resp){
            // console.log(resp);
            vm.loadingFilter = false;

            vm.tasks = resp.data.tasks;

        }, function(error){
            // console.log(error);
            vm.loadingFilter = false;
        })
    }
}

export const DepartmentTasksComponent = {
    templateUrl: './views/app/components/department-tasks/department-tasks.component.html',
    controller: DepartmentTasksController,
    controllerAs: 'vm',
    bindings: {}
};
