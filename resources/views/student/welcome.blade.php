@extends('components.layout')

@section('title', 'Журнал ВКР')

@section('custom styles')

@endsection

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Добро пожаловать в Журнал ВКР
        </h1>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Что такое ВКР?</h6>
            </div>
            <div class="card-body">
                <p>ВКР (Выпускная квалификационная работа) - это одно из двух испытаний ГИА (Государcтвенная итоговая
                    аттестация). Студенты последних курсов завершают прохождение образовательных программ высшего обучения
                    сдачей ГИА.</p><br>
                <p>Работу оценивает Государcтвенная экзаменационная комиссия (ГЭК).</p><br>
                <p class="mb-3">При выполнении ВКР выпускник с руководителем формируют пакет документов:</p>
                <table class="table ml-3">
                    <tbody>
                        <tr>
                            <td>Заявление об утверждении темы ВКР и назначении научного руководителя</td>
                            <td>Сдается на кафедру за 6 месяцев до защиты</td>
                            
                        </tr>
                        <tr>
                            <td>Задание на выполнение ВКР</td>
                            <td>Выдает руководитель выпускнику на преддипломную практику</td>
                        </tr>
                        <tr>
                            <td>Текст ВКР</td>
                            <td>Окончательный вариант сдается руководителю за две недели до защиты. Передается в ГЭК не позднее чем за 2 дня до защиты.<td>
                        </tr>
                        <tr>
                            <td>Отзыв научного руководителя</td>
                            <td>Пишет руководитель после завершения подготовки ВКР и предоставляет на кафедру. Передается в ГЭК не позднее чем за 2 дня до защиты.</td>
                        </tr>
                        <tr>
                            <td>Рецензия (по программам магистратуры и специалитета)</td>
                            <td>Руководитель направляет ВКР одному или нескольким рецензентам. Рецензент проводит анализ ВКР и представляет на кафедру письменную рецензию. Передается в ГЭК не позднее чем за 2 дня до защиты.</td>
                        </tr>
                        <tr>
                            <td>Справка о прохождении проверки на заимствование</td>
                            <td>Рукводитель приглашает выпускника через Email к загрузке ВКР в систему "Антиплагиат.ВУЗ". Система выдает значение оригинальности в процентах. Пороговые значения оригинальности следующие: для бакалавриата и специалитета - 30%, для магистратуры - 40%. НО! Выпускающая кафедра вправе повысить этот порог, но не может установить его выше 60%</td>
                        </tr>
                        <tr>
                        </tr>   
                    </tbody>
                </table>
                <p>Главным в этом списке, конечно же, является текст ВКР. К его оформлению выдвигаются требования. Посмотреть их можно в разделе "Требования к оформлению ВКР".</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">О системе</h6>
            </div>
            <div class="card-body">
                <p>Система предназначена для сопровождения выпускных квалификационных работ студента.</p><br>
                <p>Перед началом использования системы заполните анкету в своем профиле.</p>
                <p>Чтобы перейти в свой профиль вспользуйтесь верхним меню.</p><br>
                <p>Для начала работы перейдите на страницу "Выпускные работы"
                <p>
            </div>
        </div>
    </div>

@endsection

@section('custom scripts')

@endsection
