drop table if exists events;

create table events (
    event_id char(10) default (uuid()) primary key,
    start_time datetime not null,
    end_time datetime not null,
    event_details json
);

insert into events (start_time, end_time, event_details)
values
    ("2026-03-09 21:03:36", "2026-03-16 21:03:36", '{
        "event_name": "blossom sakura event",
        "destination": "Tokyo",
        "address": "unknown"
    }');

select
*
from events
where json_extract(event_details, "$.destination") = "Tokyo";