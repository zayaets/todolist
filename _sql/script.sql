create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    connection text                                not null,
    queue      text                                not null,
    payload    longtext                            not null,
    exception  longtext                            not null,
    failed_at  timestamp default CURRENT_TIMESTAMP not null
)
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table password_resets
(
    email      varchar(150) not null,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create index password_resets_email_index
    on password_resets (email);

create table roles
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    slug       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    deleted_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table tags
(
    id         bigint unsigned auto_increment
        primary key,
    text       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    deleted_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255) not null,
    email             varchar(150) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;

create table items
(
    id         bigint unsigned auto_increment
        primary key,
    text       varchar(255)         not null,
    status     tinyint(1) default 0 not null,
    user_id    bigint unsigned      not null,
    created_at timestamp            null,
    updated_at timestamp            null,
    deleted_at timestamp            null,
    constraint items_user_id_foreign
        foreign key (user_id) references users (id)
)
    collate = utf8mb4_unicode_ci;

create table item_tag
(
    item_id    bigint unsigned not null,
    tag_id     bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    deleted_at timestamp       null,
    constraint item_tag_item_id_foreign
        foreign key (item_id) references items (id)
            on delete cascade,
    constraint item_tag_tag_id_foreign
        foreign key (tag_id) references tags (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table role_user
(
    user_id    bigint unsigned not null,
    role_id    bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    deleted_at timestamp       null,
    constraint role_user_role_id_foreign
        foreign key (role_id) references roles (id)
            on delete cascade,
    constraint role_user_user_id_foreign
        foreign key (user_id) references users (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;


