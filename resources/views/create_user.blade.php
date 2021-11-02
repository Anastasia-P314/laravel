@extends('layout')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Добавить пользователя
            </h1>

        </div>
        <form action="/store" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input type="text" id="simpleinput" class="form-control" name="name">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Место работы</label>
                                    <input type="text" id="simpleinput" class="form-control" name="position">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Номер телефона</label>
                                    <input type="text" id="simpleinput" class="form-control" name="phone">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Адрес</label>
                                    <input type="text" id="simpleinput" class="form-control" name="address">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Безопасность и Медиа</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="text" id="simpleinput" class="form-control" name="email">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input type="password" id="simpleinput" class="form-control" name="password">
                                </div>

                                
                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Выберите статус</label>
                                    <select class="form-control" id="example-select" name="status">
                                        <option>Онлайн</option>
                                        <option>Отошел</option>
                                        <option>Не беспокоить</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Загрузить аватар</label>
                                    <input type="file" id="example-fileinput" class="form-control-file" name="image">
                                </div> 
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button class="btn btn-success">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

@endsection