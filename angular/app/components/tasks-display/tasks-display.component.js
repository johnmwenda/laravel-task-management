class TasksDisplayController{
    constructor(){
        'ngInject';
        this.hgt = window.innerHeight - 135;
        console.log(this.hgt);
    }

    $onInit(){
    }
}

export const TasksDisplayComponent = {
    templateUrl: './views/app/components/tasks-display/tasks-display.component.html',
    controller: TasksDisplayController,
    controllerAs: 'vm',
    bindings: {}
};
