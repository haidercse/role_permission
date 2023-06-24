-- For Organizations Table
INSERT INTO `organizations` (id,NAME,short_name,address,`created_at`,`updated_at`)
SELECT id,org_name,short_name,address,NOW(),NOW() FROM `old_organizations`;

---- For Products Table
INSERT INTO `products` (id,organization_id,user_id,NAME,short_name,description,url,email_cc,image,created_at,updated_at)
SELECT ProductId,OrgId,Assignee,ProductName,ProductShortName,ProductDescription,ProductUrl,EmailCC,ProductLogo,NOW(),NOW() FROM `old_products`;


---- For Roles Table
INSERT INTO `roles`( id, NAME, guard_name, is_internal, description, created_at, updated_at)
SELECT id,role_name,'',isInternal,role_description,NOW(),NOW() FROM `old_user_roles`

-- For Users Table
INSERT INTO `users`(id, NAME, product_id, organization_id, username, email, registration_date, email_verified_at,
PASSWORD, is_super_admin, STATUS, remember_token, fcm_token,`is_client`,created_at, updated_at)
SELECT id,employee_name,product_id,org_id,user_name,email,reg_date,'',PASSWORD,is_admin,STATUS,'','',is_client,NOW(),NOW() FROM `old_user`;


-- For model has roles table
INSERT INTO `model_has_roles` (`role_id`,`model_type`,`model_id`)
SELECT 7,'App\Models\User',id
FROM users WHERE users.`is_client`=0

INSERT INTO `model_has_roles` (`role_id`,`model_type`,`model_id`)
SELECT 16,'App\Models\User',id
FROM users WHERE users.`is_client`=1

-- For tickets table
INSERT INTO `tickets`(id, user_id, raised_by, product_id, organization_id, approved, title,
details, ticket_code, TYPE, priority,
 status_id, url, raising_date, ticket_number, related_ticket_id, COMMENT, root_cause,
 image, created_at, updated_at)

 SELECT bug_id,assigned_to,raised_by,product_id,org_id,approved,bug_subject,bug_description,request_id,
 request_type,priority,STATUS,url,raising_date,ticket_number,'','','',screenshot,NOW(),NOW() FROM `old_jos_bugs`

-- all password set 12345678
 UPDATE `users` SET users.`password`='$2y$10$a0JXKWgj9qsC0df3WqlMPOFO1oo/lU467VPDhXZbONAs5SdXvp.aa'
--  role_has_model  
 UPDATE `model_has_roles` SET `model_type` = "App\Models\User"



