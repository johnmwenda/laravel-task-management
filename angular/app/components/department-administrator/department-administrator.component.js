class DepartmentAdministratorController{
    constructor(userService, $state){
        'ngInject';
        this.userService = userService;
        this.$state = $state; 

        //
    }

    $onInit(){
        let vm = this;
        this.userService.getDepartmentCategories().then(function(resp){           
            console.log(resp);
            vm.department_categories = resp.data.categories;
        }, function(error){
            console.log(error);
        });
    }

    createNewCategory() {
        let vm = this;
        vm.addingNewCategory = true;
        console.log(this.category_data);
        this.userService.createNewCategory({category:this.category_data}).then(function(resp){
            vm.addingNewCategory = false;
            vm.category_data = {};
            vm.$state.go('app.administrator',{}, {reload:true});
            console.log(resp);

        }, function(error){
            vm.addingNewCategory = false;
            console.log(error);
        })
    }
}

export const DepartmentAdministratorComponent = {
    templateUrl: './views/app/components/department-administrator/department-administrator.component.html',
    controller: DepartmentAdministratorController,
    controllerAs: 'vm',
    bindings: {}
};
