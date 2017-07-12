class DepartmentTasksController{
    constructor($stateParams, ContextService, userService){
        'ngInject';
        let vm = this;
        this.$stateParams = $stateParams;
        this.userService = userService;

        ContextService.me(function (data) {
            console.log(data);
            vm.userData = data;
            if(angular.isDefined(vm.userData)){
                vm.current_department = vm.userData.department
                // vm.loadingFilter = true;
                vm.getInitialDepartmentTasks();
            }            
        })
    }

    $onInit(){
         let vm = this;
         vm.departments = {};
         this.userService.getAllDepartments().then(function(resp){
            // console.log(resp);
            vm.departments = resp.data.departments;
         }, function(error){
            // console.log(error);
         })
        
    }

    getInitialDepartmentTasks() {
        let vm = this;

        // console.log(this.current_filter);



        vm.userService.getDepartmentTasks(vm.userData.department.id).then(function(resp){
            // console.log(resp);
            // vm.loadingFilter = false;

            vm.tasks = resp.data.tasks; 
        }, function(error){ 
            // console.log(error);
            // vm.loadingFilter = false;
        })
    }

    changeFilter(department) {
        let vm = this;

        console.log(department);
        vm.current_department = department

        vm.tasks = []; 
        this.loadingFilter = true;

        this.dep_id = vm.current_department.dep_id;

        console.log(this.dep_id);

        this.userService.getDepartmentTasks(this.dep_id).then(function(resp){
            // console.log(resp);
            vm.loadingFilter = false;

            vm.tasks = resp.data.tasks;

        }, function(error){
            // console.log(error);
            vm.loadingFilter = false;
        })
    }   

    all_tasks() {
        let vm = this;

        this.loadingFilter = true;

        this.dep_id = vm.current_department.id;

        // console.log(this.dep_id);

        this.userService.getDepartmentTasks(this.dep_id).then(function(resp){
            // console.log(resp);
            vm.loadingFilter = false;

            vm.tasks = resp.data.tasks;

        }, function(error){
            // console.log(error);
            vm.loadingFilter = false;
        })
    }

    public_filter (filter) {
        let vm = this;
        if(filter) {
            this.loadingFilter = true;

            // this.dep_id = vm.current_department.id;
            // console.log(vm.current_department);

            this.userService.getDepartmentTasks(vm.current_department.id, 'department_public_tasks=true').then(function(resp){
                // console.log(resp);
                // vm.loadingFilter = false;

                vm.tasks = resp.data.tasks;

            }, function(error){
                // console.log(error);
                // vm.loadingFilter = false;
            })
        }else {
            this.all_tasks();
        }
    }

    private_filter(filter) { 
        let vm = this;
        if(filter) {
            // this.loadingFilter = true;

            



            this.userService.getDepartmentPrivateTasks(vm.current_department.id).then(function(resp){
                // console.log(resp);
                // vm.loadingFilter = false;

                vm.tasks = resp.data.tasks;

            }, function(error){
                // console.log(error);
                // vm.loadingFilter = false;
            })
        }else {
            this.all_tasks();
        }
    }
}

export const DepartmentTasksComponent = {
    templateUrl: './views/app/components/department-tasks/department-tasks.component.html',
    controller: DepartmentTasksController,
    controllerAs: 'vm',
    bindings: {}
};
