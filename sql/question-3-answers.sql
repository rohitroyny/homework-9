-- select by id 1:
SELECT * FROM `posts` WHERE id=1; 

-- select all posts where title = includes "title 2":
SELECT * FROM `posts` WHERE title like '%title 2%'; 

-- select all posts and order by the title column alphabetically:
SELECT * FROM `posts` ORDER BY title ASC; 

-- insert 3 new posts
insert into posts (title, description) values ('test post title 3', 'test post description 3');
insert into posts (title, description) values ('test post title 4', 'test post description 4');
insert into posts (title, description) values ('test post title 5', 'test post description 5');

-- update posts where id = 1, set the title to "new title"
UPDATE `posts` SET `title`='new title' WHERE id=1; 

-- delete post where id = 2
DELETE FROM `posts` WHERE id=2;
