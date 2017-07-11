class CreateTaskController{
    constructor(userService, $anchorScroll, $location){
        'ngInject';
        this.userService = userService;
        this.$anchorScroll = $anchorScroll;
        this.$location = $location;

        //
    }

    $onInit(){
        let vm = this;
        this.data = {}
        this.access_level = ['private', 'public']; 
        this.priority = ['Low', 'Normal', 'High']; 

        this.data.access_level = 'public';
        this.data.priority = 'Normal';

        this.userService.getTaskCategories().then(function(resp){
            console.log(resp);
            vm.categories = resp.data.categories;
            vm.data.category = vm.categories[0]
        }, function(error){
            console.log(error);
        })

        this.userService.getAllUsers().then(function(resp){
            console.log(resp);
            vm.allUsers = resp.data.users;
        }, function(error){
            console.log(error);
        });

        this.userService.getDepartmentAndUsers().then(function(resp){
            console.log(resp);
            vm.departmentsAndUsers = resp.data.departments;
        }, function(error){
            console.log(error);
        });

    }

    departmentSelected(department) {
        if(department.selected){
            angular.forEach(department.members, function(value, key){
                value.selected = true;
            });
        }else {
            angular.forEach(department.members, function(value, key){
                value.selected = false;
            });
        }
    }

    memberSelected(department_id) {
        let vm = this;
        
        var status = [];

        angular.forEach(vm.departmentsAndUsers[department_id]['members'], function(value, key) {
            console.log(value.selected);
            
            if(value.selected == false || value.selected == undefined) { 
                console.log('called')
               this.push('false');
            }else {
                this.push('true');
            }
        }, status);
        console.log(status);
        let final_status = true;
        angular.forEach(status, function(value, key){
            if(value == 'false'){
                final_status = false
            }
        });
        vm.departmentsAndUsers[department_id]['selected'] = final_status;
    } 

    createTask() {
        let vm = this;
        // console.log(vm.data);
        vm.taskCreatedSuccess = false;
        vm.taskCreatedError = false;

        let selected_departments = [];
        let selected_members = [];

        angular.forEach(vm.departmentsAndUsers, function(value, key) {
            console.log(value.selected);
            
            if(value.selected == true) { 
                //department is selcted, push its id to selected_departments
                selected_departments.push(value.dep_id);
            }else {
                //loop over all members and push selected to selected_members
                angular.forEach(value['members'], function(value, key){
                    if(value.selected == true){
                        selected_members.push(value.email);
                    }
                });
            }
        });

        // console.log(selected_members);
        // console.log(selected_departments);

        vm.data.notify = {};
        vm.data.notify['departments'] = selected_departments;
        vm.data.notify['members'] = selected_members;

        console.log(vm.data);

        this.userService.createTask({task: vm.data}).then(function(data){
            vm.taskCreatedSuccess = true;
            vm.$location.hash('cytonn-app');
            vm.$anchorScroll();
        }, function(error){
            vm.taskCreatedError = true;
            vm.$location.hash('cytonn-app');
            vm.$anchorScroll();
        })
    }   
}

export const CreateTaskComponent = {
    templateUrl: './views/app/components/create_task/create_task.component.html',
    controller: CreateTaskController,
    controllerAs: 'vm',
    bindings: {}
};
