class TaskDetailDirectiveController{
    constructor(userService, $state, ContextService, $location, $anchorScroll, $stateParams){
        'ngInject';
        let vm = this;
        this.userService = userService;
        this.$state = $state;
        this.$location = $location;
        this.$anchorScroll = $anchorScroll;

        this.$stateParams = $stateParams;

        ContextService.me(function (data) {
            console.log(data)
            vm.userData = data;
        })
    }

    $onInit(){
        let vm = this;
        console.log('called task detail');
        if(angular.isDefined(this.$stateParams.id)) {
            vm.loadingfilterDetail = true;
            vm.userService.getSingleTask(this.$stateParams.id).then(function(resp){
                vm.loadingfilterDetail = false;
                // console.log(resp);
                vm.task = resp.data.task;
            }, function(error){
                vm.loadingfilterDetail = false;
                // console.log(error);
            });
        }

        this.progress_data = {};
        this.statuses = ['ON GOING', 'COMPLETE', 'NOT STARTED'];
        this.progress_data.overall_status = 'NOT STARTED';



        this.notifications = [
  {
    "id": "ecfb468e-32b9-49d3-87c7-8477c4b79ba0",
    "data": {
      "type": "create_task",
      "reporter_name": "Alice Department Head",
      "task_name": "asd"
    },
    "notifiable_type": "App\\User",
    "read_at": null,
    "task_id": null,
    "$$hashKey": "object:59"
  },
  {
    "id": "96d1ba05-5a76-4892-9566-8247420fc793",
    "data": {
      "message": "Temporary placeholder"
    },
    "notifiable_type": "App\\User",
    "read_at": null,
    "task_id": null,
    "$$hashKey": "object:60"
  }
];
    }

    $onChanges(changes) {
        let vm = this;
        
        // 
        if(!changes.taskid.isFirstChange()){

            if(angular.isDefined(changes.taskid) ){
                // console.log(changes.taskid); 
                console.log('called onChanges task detail directive',changes);
                let taskid_inner = changes.taskid.currentValue;
                // if(vm.taskid == undefined) {
                //     vm.task = {};
                // }
                vm.loadingfilterDetail = true;
                let taskid_inner_result = null;
                if(taskid_inner == null) {
                    taskid_inner_result = 'null'
                }else{
                    taskid_inner_result = taskid_inner
                }

                console.log(taskid_inner_result);

                vm.userService.getSingleTask(taskid_inner_result).then(function(resp){
                    vm.loadingfilterDetail = false;
                // console.log(resp);
                vm.task = resp.data.task;
            }, function(error){
                vm.loadingfilterDetail = false;
                vm.task = {};
            });
            }
        }

        
    }

    changeCurrentStatus() {
        if(this.progress_data.overall_status == 'NOT STARTED') {
            this.progress_data.progress_status_percent = "0";
        }else if(this.progress_data.overall_status == 'COMPLETE') {
            this.progress_data.progress_status_percent = "100";
        }else {
            this.progress_data.progress_status_percent = null;
        }
    }

    goToDetailPage(id) {
        if(this.$state.current.name == 'app.single-task' || this.$state.current.name =='app.tasks.single-task') {
            return;
        }

        this.$state.go('app.tasks.single-task', {id:id});
    }

    addProgressMessage(id) {
        let vm = this;
        this.show_progress_created = false;
        this.show_progress_error = false;

        console.log(this.progress_data);

        this.loadingfilterDetail = true;
        this.userService.addProgressMessage(id, {progress: this.progress_data}).then(function(resp){
            vm.loadingfilterDetail = false;
            vm.$location.hash('cytonn-app');
            vm.$anchorScroll();
            console.log(resp);
            vm.show_progress_created = true;
            vm.task = resp.data.task;
            vm.progress_data = {};


        }, function(error){
            vm.loadingfilterDetail = false;
            vm.$location.hash('cytonn-app');
            vm.$anchorScroll();
            console.log(error);
            vm.show_progress_error = true;
        });
    }

}

export const TaskDetailDirectiveComponent = {
    templateUrl: './views/app/components/task-detail-directive/task-detail-directive.component.html',
    controller: TaskDetailDirectiveController,
    controllerAs: 'vm',
    bindings: {
        taskid: '<'
    }
};
