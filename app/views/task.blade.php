@extends('layouts.master')

@section('title')
&ndash; Tasks
@stop

@section('css')
    .app {
        max-width: 600px;
        margin: auto;
    }
    #togo-newtask {
        text-align: center;
    }
    .togo-empty-list {
        text-align: center;
    }
    .togo-task-checkbox {
        text-align: center;
    }
    .togo-task-completed {
        text-decoration: line-through;
        font-weight: 700;
        color: #c5c5c5 !important;
    }
    .togo-task {
        margin-bottom: 10px;
    }
    .row-fluid {
        text-align: center;
    }
    .togo-task-checkbox {
        vertical-align: top !important;
    }
@stop

@section('content')
    <div class="app well" ng-app="togo" ng-controller="TaskController">
        <header id="togo-header">
            <p class="lead">Hello, {{ Auth::user()->name }}!</p>

            <div class="row-fluid">
                <form class="form-inline" ng-submit="addTask()">
		    <div class="span12 input-append">
	                <input type="text" id="togo-newtask" class="span11" name="togo-newtask" placeholder="What do you need to do today?" ng-model="newTaskTitle" title="Hit Enter/Return to save."  autofocus>
                    </div>
                </form>
            </div>
        </header>

        <hr>

        <section id="togo-body">
            <div class="row-fluid togo-empty-list" ng-hide="tasks.length > 0">
                <p class="lead muted">Looks like you don't have any chores right now, hurray!</p>
            </div>

            <div class="row-fluid togo-task" ng-repeat="task in tasks">
                <form class="togo-list-task form-inline" ng-submit="updateTask(task)">
                    <div class="span12 input-prepend input-append">
                        <span class="add-on">
                            <input type="checkbox" class="togo-task-checkbox" ng-change="updateTask(task)" ng-model="task.completed">
                        </span>
                        <input type="text" class="span10 togo-task-title" ng-model="task.title" ng-class="{'togo-task-completed': task.completed}" title="Hit Enter/Return to save.">
                        <button button="button" class="btn" ng-click="destroyTask(task)" title="Remove this task from the list."><i class="icon-trash"></i></button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@stop

@section('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/angularjs/1.1.2/angular.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/angularjs/1.1.2/angular-resource.min.js"></script>
    <script type="text/javascript">

        var togoServicesModule = angular.module('togoServices', ['ngResource']);
        var togoAppModule = angular.module('togo', ['togoServices']);

        togoServicesModule.factory('Task', function($resource)
            {
                return $resource(
                        '/api/v1/task/:id',
                        {},
                        {
                            'update': { method: 'PUT'}
                        }
                    );
            });

        togoAppModule.controller('TaskController', function TaskController($scope, Task)
            {
                var tasks = $scope.tasks = Task.query(function() {
                        // Parse the `completed` attribute of each task and convert them from integer/string to boolean.
                        for(var i = 0; i < tasks.length; i++)
                            tasks[i].completed = tasks[i].completed == 1;
                    });

                $scope.addTask = function() {
                    if( !$scope.newTaskTitle.length ) return; // Check for a blank title

                    var task = new Task(); // Create a new task model with values
                    task.title = $scope.newTaskTitle;
                    task.completed = false;

                    tasks.push(task); // Push the new model onto the list

                    task.$save(); // Save the model server side

                    $scope.newTaskTitle = ''; // Clear the new task field

                };

                $scope.updateTask = function(task) {
                    if( !task.title ) $scope.destroyTask(task); // Remove the task if the title is empty

                    task.$update( { id: task.id } ); // Update the server side model
                };

                $scope.destroyTask = function(task) {
                    task.$delete( { id: task.id } ); // Remove the server side model

                    tasks.splice( tasks.indexOf(task), 1 ); // Remove the model from the list
                };
            });

    </script>
@stop
