class TaskDetailDirectiveController{
    constructor(userService, $state, ContextService, $location, $anchorScroll){
        'ngInject';
        let vm = this;
        this.userService = userService;
        this.$state = $state;
        this.$location = $location;
        this.$anchorScroll = $anchorScroll;

        ContextService.me(function (data) {
            console.log(data)
            vm.userData = data;
        })
    }

    $onInit(){
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
        // console.log('called onChanges',changes);
        if(angular.isDefined(changes.taskid) ){
            // console.log(changes.taskid); 
            vm.taskid = changes.taskid.currentValue;
            // if(vm.taskid == undefined) {
            //     vm.task = {};
            // }
            vm.loadingfilterDetail = true;
            // console.log(vm.taskid);
            vm.userService.getSingleTask(vm.taskid).then(function(resp){
                vm.loadingfilterDetail = false;
                // console.log(resp);
                vm.task = resp.data.task;
            }, function(error){
                vm.loadingfilterDetail = false;
                // console.log(error);
            });
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
