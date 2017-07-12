class TasksDisplayController{
    constructor(){
        'ngInject';
        this.hgt = window.innerHeight - 135;
        
    }

    $onInit(){

    } 

    $onChanges(changes) { 
        let vm = this;
        vm.taskid = null;
        
console.log('called onChanges',changes);
        if(angular.isDefined(changes.tasks)){
            if(!changes.tasks.isFirstChange()){
                
                if(changes.tasks.currentValue.length == 0){
                    vm.taskid = null;
                }else {
                    vm.taskid = changes.tasks.currentValue[0]['id'];    
                }



                // console.log('task id in parent',vm.taskid); 
            }
        }
        
        

    }

    displayOnSide() {
        
    }
}

export const TasksDisplayComponent = {
    templateUrl: './views/app/components/tasks-display/tasks-display.component.html',
    controller: TasksDisplayController,
    controllerAs: 'vm',
    bindings: {
        tasks: '<',
        loadingfilter: '<'
    }
};
