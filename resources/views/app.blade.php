<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="css/app.css">
    </head>
    <body>
        <div id="app">
            <div class="container pt-4">
                <div class="title">
                    <div class="row">
                        <h1 class="d-flex align-items-end">hello, here's list of tasks for today</h1>
                        <a class="d-flex align-items-end ml-4" @click="add_task"  @click.prevent="" href="/" >add new</a>
                    </div>
                </div>
                <div class="content">
                    <div class="row pt-4">
                        <task :key="task.updated_at"
                              :id="task.id"
                              :content="task.content"
                              :is_complete="task.is_complete"
                              v-for="task in actual_tasks"
                              class="mx-4">
                        </task>
                    </div>
                    <h4>completed tasks</h4>
                    <div class="row pt-4">
                        <task
                            :key="task.updated_at"
                            :id="task.id"
                            :content="task.content"
                            :is_complete="task.is_complete"
                            {{--:class="{completed: task.is_complete}"--}}
                            v-for="task in complete_tasks"
                            class="mx-4">
                        </task>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/app.js"></script>
    </body>

</html>
