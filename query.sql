SELECT p.user_id, p.id, p.image_url, c.id, c.comment_text, lc.total_likes 
FROM photos p
INNER JOIN comments c ON p.id=c.photo_id 
INNER JOIN (SELECT count(*) AS total_likes, photo_id FROM likes GROUP BY photo_id) lc ON p.id=lc.photo_id;
