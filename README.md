# Web-shedule

php приложение для вывода студенческого расписания. [Демо](http://иату.рф/testraspisanie/)

  - Расписание студентов
  - Расписание преподавателей
  - Поддержка cookie
  - Активное развитие проекта

### Требования

  - php7 (php5 - не гарантируется)
  - База данных, имеющая таблицу (или представление) следующего вида:

| ДАТА | ГРУППА | ВРЕМЯ НАЧАЛА | ВРЕМЯ КОНЦА | ДИСЦИПЛИНА | ТИП ЗАНЯТИЯ | ПРЕПОДАВАТЕЛЬ | АУДИТОРИЯ |
| ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------ |
| 2018-03-16 | АБВГ-12 | 08:30 | 10:05 | Бухгалтерия | Лекция | Иванов И.И. | 310 |
| 2018-03-16 | ИБПГ-22 | 12:30 | 14:05 | Программирование | Зачет | Пупкин В.И. | 404 |
| 2018-03-17 | ПБСГ-44 | 08:30 | 10:05 | Логистика | Практика | Петров П.П. | 317 |
  - Две справочные таблицы преподавателей и групп (При необходимости можно реализовать иначе) 

### Установка
  - Скачать данный репозиторий 
  - Разархивировать в папку вебсервера
  - Настроить подключение к базе данных в файле config.php
  - Исправить запросы при необходимости в файле functions.php

### PS:
Вдохновлено и форкнуто от [krimba/raspis](https://github.com/krimba/raspis)