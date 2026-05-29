-- Complete Product Import for Truly Rare Customs
-- Run this file in phpMyAdmin or MySQL directly

-- Fix character encoding to support emojis and special characters
SET NAMES utf8mb4;
ALTER DATABASE trc_products CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE products CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit S, Pink', 'Acid washed grey jogging jorts, handcrafted using premium materials to emphasize STYLE & COMFORT. Pair these TR heart stamped smokey grey shorts with a matching TR tee for a chill or special occasion. Either way they should be in your closet, cop now!


Detail:
Fit- Jorts/Boyfriend Style
Design: Truly Rare ""heart"" logo in pink or white
Specs:  100% Cotton, Dyed to match drawcords. Back pocket and jersey-lined front pocket n sides. Tapered at the knee.', 30.00, 'E535075', '{"default": 8}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit S, White', '', 30.00, '7997854', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit M, Pink', '', 30.00, 'M550286', '{"default": 4}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit M, White', '', 30.00, 'P043652', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit L, Pink', '', 30.00, 'W087858', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit L, White', '', 30.00, 'Q043487', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit XL, Pink', '', 30.00, '614911D', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit XL, White', '', 30.00, '745767X', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit 2XL, Pink', '', 30.00, 'K353988', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Jorts/ Boyfriend Fit 2XL, White', '', 30.00, '9815467', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Set Regular', 'The Acid Astro Set features vibrant colors and a unique design that is sure to enhance your space. Crafted from high-quality materials, this set is both durable and visually striking. Elevate your surroundings with this exceptional collection that brings a touch of modern elegance to any room.', 35.00, '696615P', '{"default": 51}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Set Size', '', 40.00, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, S, Pink', '', 20.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, S, White', '', 20.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, M, Pink', '', 20.00, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, M, White', '', 20.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, L, Pink', '', 20.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, L, White', '', 20.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, XL, Pink', '', 20.00, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Black, XL, White', '', 20.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, S, Pink', '', 20.00, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, S, White', '', 20.00, '', '{"default": 3}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, M, Pink', '', 20.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, M, White', '', 20.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, L, Pink', '', 20.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, L, White', '', 20.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, XL, Pink', '', 20.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Acid Astro Shirt Grey, XL, White', '', 20.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Against The Grain -Sip + Paint Session Regular', 'Against the Grain is a new monthly networking event that unites STL Artist, creators, and innovators. Feeling crafty? Add on a Sip + Paint ticket to top off the vibes! Available from beginning to end of the event until supplies last So grab your ticket NOW so we can plan accordingly!


Sip & Paint Ticket Option:
Upgrade your experience with our Sip & Paint session — includes all art materials, wine, and guided mini-lessons. Bringing a friend? Get both tickets for just', 30.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Against The Grain- Networking Event Regular', 'Against the Grain is a new monthly networking event that unites STL Artist, creators, and innovators. Each month will be centered around a different art realm, organized so people make lasting connections. 

RSVP below so we can know how many people to expect!', 0.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Against The Grain- Sip + Paint Session Regular', 'Against the Grain is a new monthly networking event that unites STL Artist, creators, and innovators. Feeling crafty? Add on a Sip + Paint ticket to top off the vibes! Available from beginning to end of the event until supplies last So grab your ticket NOW so we can plan accordingly!




Sip & Paint Ticket Option:
Upgrade your experience with our Sip & Paint session — includes all art materials, wine, and guided mini-lessons.', 30.00, 'Q209591', '{"default": 30}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Boss Chick Trench Regular', 'This sexy grey double breasted trench coat is dripped with Truly Rare brush strokes, has black leather panels and ""TR"" symbol on the back. To enhance the its style I customized a diamond belt.', 50.00, 'A773825', '{"default": 1}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Canvas Club:Free Membership Regular', 'Step into the Rare. Our free membership is your first key into the Truly Rare universe. As a Species member, you''ll unlock:<br/><br><br/><ul><li>🛍️ Loyalty Rewards – Every 10 items you cop get a free t-shirt drop from us! </li><li>🎂 Birthday Love – surprise perks &amp; discounts to celebrate your day.</li><li>🚚 Exclusive Shipping Deals – savings that keep your fits flowing.</li><li>🎁 Members-Only Surprises – random drops, secret deals, and love just for showing up.</li></ul><br><br/><br><br/>No cost. Just community, culture, and creativity — consider this your invitation to belong.<br/><br/>', 0.00, '6400160', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Cosmic Connections: Cocktail Hour Regular', 'Enjoy an stellar networking event fr. Free themed cocktails, food, and non profit organizations to mingle with! 🥳🥳 
Perfect selection if you''re building your network, partnerships and collaborations with local & corporate businesses!', 35.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Cosmic Connections: Fashion Show Regular', 'Enjoy an immersive galaxy runway show ft. Two dope local designers! 
Come match our fly- The vibe is Luxury Streetwear! ✨', 35.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Cosmic Connections: Galaxy Gala & Fashion Show', '🌌 CELESTIAL SOIRÉ🌌
A Galaxy-Themed Gala & Fashion Show
Celebrating 4 Years of Brilliance, Style, and Community!🥳


👟 SNEAKER BALL DRESS CODE
Dress it up. Lace it down. Rock your best formalwear with your freshest kicks!


✨ EVENT HIGHLIGHTS


🍸 Cocktail Hour – Signature drinks + Catered Dinner


💼 Small Business Spotlights – Featuring local orgs that support entrepreneurs




🎁 Silent Auction – Bid on exclusive items & experiences


🌠 Runway Fashion Show – Cosmic-inspired looks


🎟️ Tickets:
General Admission – $60

VIP Admission – $75 (includes a custom event t-shirt, a signature cocktail, and exclusive front-row seating for the fashion show) ***SEE OUR VIP TICKET LINK TO PURCHASE***', 25.00, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Cosmic Connections: VIP Seating Regular', 'Get all the goodies from general admission PLUS MORE!!! This ticket includes a front row seat to the show, a Truly Rare shirt and a gift bag to take home! ✨🥳', 75.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom Denim Jacket Regular', 'Standard custom denim jacket including 1 DTF transfer.', 80.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom Hoodie Regular', 'This price reflects the standard cost of a custom hoodie with one DTF design. Any additional designs must be added on modifiers.', 45.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom Set (Hoodie + Pants) Regular', '', 95.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom Set (T-Shirt + Pants) Regular', 'Quality 2 piece set featuring a t shirt and pants with one custom design on both!', 55.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom Shirt Regular', 'Transform your basic t-shirt into a Truly Rare Classic by personalizing it however you want! You want to add paint- GO FOR IT, it doesn''t fit perfectly- LET''S CHANGE THAT, want to add a heat pressed detail- THE WORLD IS YOURS! 


Please insert as much details as possible so we can get your design perfect for you! If you have an example photo please submit it through the contact page and someone will reach out to you for a consultation soon!', 20.00, '1098860', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom Shoes Regular', 'You bring the shoes we make them new! First we do a light clean and restore then work our magic- this price includes one basic design. Add on additional price based on how detailed and big your design is', 125.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom Sleep Mask Regular', '', 35.00, 'F965125', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Custom T shirt -Standard Regular', 'This price reflects the basic one side design of', 0.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Design & Labor Regular', '', 18.00, 'H156410', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Diamond In The Rough-Zip Up Hoodie Regular', 'Ultra soft Smokey Grey unisex Icy hoodie. This zip up features starlite rhinestones on the hood, sleeves andpocketst to compliment the raged distressed edges.', 59.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('EOBCOne Day Pop In Regular', '', 75.00, 'E984478', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Earrings Regular', 'What''s a good Truly Rare fit without the perfect pair of earrings to complete the look! Each 6 pack of earrings feature unique styles, color combos, and sizes to complement your everyday motion or those special moments.', 7.99, 'M062800', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Embroidery Service', '', 40.00, '', '{"default": 0}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Embroidery Setvice', 'The text on the navy blue velvet blanket will read:

Elishau
Nov 4
5lbs 9oz
In Gold stiching', 40.00, '', '{"default": 0}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Embroidery service', 'This price includes the set up of the machine, thread, other materials, labor and time. It does NOT include the price of the base material.', 40.00, '', '{"default": 0}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Flower Child Tees S', '', 25.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Flower Child Tees M', '', 25.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Flower Child Tees L', '', 25.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Flower Child Tees Kids Small', '', 25.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Flower Child Tees Kids medium', '', 25.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Flower Child Tees Kids large', '', 25.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Free T-Shirt (Loyalty Program) Regular', '<p><br></p><p><strong>Cop, wear, repeat — after 10, your next tee comes free. Loyalty pays off in Rare styles ✨🤩🤩</strong></p><p><br></p>', 0.00, '1952269', '{"default": 0}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Full back patch Regular', 'Full back design or large centerpiece patch (includes alignment and reinforcement).', 45.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Galaxy Gala & Fashion Show- General Admission Regular', 'Celebrate Truly Rare Customs 4 year anniversary at our first Gala and Fashion Show event. This multi hour event will feature a cocktail hour, gala dinner, silent auction and a themed fashion show!
Feel empowered speaking to local businesses and resourceful organizations, whether you''re an entrepreneur, aspiring to be or just want to support a local business this event is for YOU!', 75.00, '3939602', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Golden Pearl jeans S', 'These mom jeans are EVERYTHING BUT BASIC! Each pearl has been carefully placed on these extra curved high-waisted jeans with gold streaks! That''s a lot I know but they need no explanation they speak for themselves!


Oh yeah & they snatch you at the waist perfectly!', 45.99, 'G706844', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Golden Pearl jeans M', '', 45.99, 'E735128', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Grill & Game night Regular', '🎉 Cookout & Game Night: Sip, Paint, Eat, Play! 🎮🍽️

Join us for an unforgettable evening of food, fun, and friendly competition at our Cookout & Game Night! Whether you''re an artist, foodie, or gamer, we''ve got something for everyone.

🖌️ Sip & Paint: Unleash your creativity with a relaxing sip-and-paint session! Enjoy a drink in hand as you follow along with an easy, fun painting experience—perfect for all skill levels.

🍔 Delicious Food & Drinks: Savor mouthwatering cookout classics on the grill, plus a variety of refreshing drinks to keep the vibe going all night long.

🎮 Console Games: Get your game face on! Challenge your friends to console gaming battles on the big screen.

🎲 Board Games: Not into video games? We''ve got a selection of exciting board games for all ages and interests—perfect for getting everyone involved.

📅 When: July 5th  2:00 PM – 10:00 PM
💰 Cost: $15 (Food, drinks, and entertainment included!)

Whether you''re here to chill with a drink, create a masterpiece, or show off your gaming skills, you won''t want to miss this awesome mix of activities. Bring your friends, family, or come solo—everyone''s welcome to enjoy a day of good vibes, great food, and epic fun!

**RSVP** today and get ready for a day of endless fun! 🎉✨', 15.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Head in the clouds Jogging Sets S', '', 0.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Head in the clouds Jogging Sets M', '', 0.00, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Head in the clouds Jogging Sets XL', '', 0.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Head in the clouds tee S', 'Experience the ultimate in comfort and style with our Heads in the Clouds short sleeve tee. Crafted from high-quality materials, this shirt comes in a relaxed fit that is perfect for all-day wear. Stand out from the crowd with this unique quote and dope design  making it a must-have addition to your wardrobe. 

Fit: Relaxed short sleeve tee
Design: ""Head in the Clouds Art on my Sleeve"" Quote ft. Truly Rare Heart on the chest area
Specs: 100% cotton, Jet Black', 20.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Head in the clouds tee L', '', 20.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Heads in the clouds hoodie Regular', 'Experience the ultimate in comfort and style with our Heads in the Clouds Hoodie. Crafted from high-quality materials, this hoodie offers a comfortable fit that is perfect for all-day wear. Stand out from the crowd with the unique design of this hoodie, making it a must-have addition to your wardrobe. Elevate your casual look with the Heads in the Clouds Hoodie today!', 35.00, '1890034', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Holiday Game Night- FREE Regular', 'Join us for a chill Game Night with Zax Tech at the shop! 🎲✨ Vendors, good vibes, and games of all kinds. 
Free to hang out—come through and play!
Please RSVP below so we can know how many people to expect! See you soon☺️', 0.00, 'T086478', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Holiday Game Night- Sip & Paint 🎫 Regular', 'Level up your Game Night with our Sip & Paint experience! 🎨🍷 Grab a spot for $30 and create your own masterpiece while enjoying the fun, games, and chill vibes.', 30.00, 'Y236312', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Holiday Pop Up Vendor Experience 🎄 Regular', '<p>Starting from Nov 1- Dec 30th we''ll be opening up the luxury EOBC retail doors to local retail businesses in the STL  Grove area! This Holiday experience is completely customizable to your needs, for startup and fully launched businesses.✨</p><p><br></p><p>Join us during our many in store event days, rent a shelf or come set up for the whole season! We accept and encourage all businesses to apply as soon as possible as spots are going fast 💨🏃‍♀️</p><p><br></p><p><br></p><p>All we need from you is to completely read the guidelines and fill out the application and we''ll be in touch soon for next steps. Please feel free to email us at <a target=""_blank"" rel=""noopener noreferrer nofollow"" href=""mailto:trulyrarecustoms@gmail.com"">trulyrarecustoms@gmail.com</a> for any questions or concerns! ☺️</p><p><br></p><p>Each vendor spot includes:</p><p><br></p><p>🎁Warm + Cozy retail space in Grove area</p><p> 🛍️Dedicated pop-up space</p><p>🎶 Holiday vibes + fun events </p><p>📸 Professional content opportunities</p><p>☕ Refreshments + community networking</p>', 0.00, 'B742828', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('ICU jeans Regular', '', 30.00, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Icy Intentions Zip up hoodie Regular', 'This zip-up hoodie is all about shine and statement. Covered in rhinestones with the Truly Rare logo stamped on the back, and extra sparkle on the hood. Bold, warm, and built to flex.

* Zip-up front
* Rhinestone-covered hood
* Truly Rare logo on back
* Limited edition, one-of-one', 60.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Icy Intentions- Jogging Pants Regular', 'These quilted padded pants bring heat and shine all in one. Covered in rhinestones and designed for comfort with structure, they''re built to stand out while keeping you warm.<br/><br/><ul><li> All-over rhinestone detail</li><li> Relaxed, unisex fit</li><li> Limited edition, one-of-one design</li></ul><br/>---<br/><br/>Let me know if you&#39;d like to add a pocket detail, drawstring info, or suggested styling!<br/>', 65.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Icy Intentions- Zip Up Set Regular', 'This zip-up hoodie and quilted padded pants set is fully iced out with rhinestones for maximum shine. Features the Truly Rare logo across the back and rhinestones on the hood. Warm, bold, and built to stand out.

* Quilted padded pants + zip-up hoodie
* All-over rhinestones
* Truly Rare logo on back
* Limited edition, one-of-one style', 0.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Jean Tote Bag- Light washed Regular', 'These hand sewn up cycled jean tote bags, come with a red silk lining for protection and style! And stamped with the TR heart logo and ""Me Myself & God"" puff vinyl. The perfect gift for your stylish sister, friend, mom or add it to your own closet to brighten it up!', 74.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Jean Tote bag- Vintage Regular', 'These hand sewn up cycled jean tote bags, come with a red silk lining for protection and style! And stamped with the TR heart logo and ""Me Myself & God"" puff vinyl. The perfect gift for your stylish sister, friend, mom or add it to your own closet to brighten it up! This one comes with a braided double strap and light bleach spots to compliment the red and white paint splatters!', 74.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Junk Socks Red', 'These medium length comfy socks are far from your basic pair! They ft. Various sizes pearls, unique charms and are one size fits all! Choose between the cherry red pair or the classic black.', 11.99, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Junk Socks Black', '', 11.99, '', '{"default": 9}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Large patch (6-8") Regular', 'For oversized patches or statement pieces on sleeves, chest, or back.', 25.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Line Dancing Regular', 'Grab your friends, your dancing shoes, a botlte and head over to learn some new moves! This event will be led by trained dancer and owner Gabriel, and her assistant Tonio. Get ready to end this summer off with your boots on the ground and fans high let''s work up a sweat!', 5.00, '5737332', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Loners + Lovers Sip & Create: BYOGarment Regular', 'Bring Your Own Garment (BYOG) lets you turn your favorite piece into wearable art. Bring a hoodie, jacket, tote bag, or other fabric item to customize.  Whatever floats your boat.
No shoes allowed.  

This option includes everything from the Canvas Creation experience, plus access to durable fabric design materials such as iron-on patches, rhinestones, and heat transfer designs so your piece lasts for years to come!', 50.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Lovers + Loners Sip & Create: All Included (Garment+Materials) Tshirt', 'Truly Rare Provided Garment is for those who want the full experience without bringing anything. We''ll provide a premium 100% cotton garment for you to customize on-site.  

This option includes guided instruction, all fabric design materials, music, vibes, and a ready-to-design piece so you can focus purely on creating something custom and one-of-one.

**All tickets include lite bites & BYOB access with the option to add on $8 for a variation of wine for (up to 3 glasses per guest)', 60.00, 'T456614', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Lovers + Loners Sip & Create: All Included (Garment+Materials) Tote Bag', '', 65.00, '258649J', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Lovers + Loners Sip & Create: All Included (Garment+Materials) Hoo', '', 75.00, '2416415', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Lovers + Loners Sip & Create:Canvas Regular', 'Canvas Creation is perfect if you want to relax, sip, and paint without overthinking it. This option includes a blank canvas, a full paint kit, and step-by-step guided instruction to help bring your vision to life. Enjoy a BYOB-friendly space, good music, and an easygoing creative flow. Just show up and paint.', 40.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Me Myself & God Spray painted Long Sleeve Tee Shirts Kids large', 'Step into your season of purpose with our Me Myself &amp; God Long Sleeve Tee, featuring a hand-spray-painted iridescent finish that makes every piece feel like wearable art. Designed on a rich earth-brown base, this tee stands out with a soft, glowing pink puff print message on the back: Me, Myself &amp; God — a reminder of alignment, grounding, and unapologetic confidence.<br/><br><br/>Each shirt is uniquely spray painted for a subtle abstract texture, making no two pieces exactly alike. Comfortable, breathable, and perfect for everyday expression, this long sleeve blends streetwear energy with a personal spiritual touch — truly 1 of 1.<br/><br><br/><br><br/><br><br/><br><br/><strong>Features</strong><br/><br><br/><br><br/><ul><li>Hand-spray-painted iridescent detailing for a soft, shimmering finish</li><li>Pink puff print graphic on the back for texture + dimension</li><li>Abstract dyed brown base for an earthy, grounded look</li><li>Unisex long sleeve fit — comfortable, everyday wear</li><li>Made by Truly Rare Customs: art-forward, intentional, and unique</li></ul><br><br/>', 25.99, '9680489', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Me Myself & God Spray painted Long Sleeve Tee Shirts 3XL', '', 27.99, '2758444', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Me Myself & God Spray painted Long Sleeve Tee Shirts Small', '', 25.99, '1224200', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Me Myself & God Spray painted Long Sleeve Tee Shirts Med', '', 25.99, '8183924', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Me Myself & God Spray painted Long Sleeve Tee Shirts Large', '', 25.99, 'Y213020', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Me Myself & God Spray painted Long Sleeve Tee Shirts Extra Large', '', 25.99, '893553K', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Me Myself & God Spray painted Long Sleeve Tee Shirts 2 Extra Large', '', 27.99, '1346443', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Medium patches (3-6") Regular', 'Sewing for mid-size patches like Greek letters, names, or crest logos.', 15.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One Of Wun- Custom Jacket Regular', 'This icy blue jean jacket is the definition of a One of Won, Truly Rare custom design. Yes, it''s hand painted & yes you can wash it, just make sure you handle with care it is a work of art you know! Turn it inside out for a muted statement ft the Truly Rare logo stamped on the lining, either way you can''t loose!


Fit: Small/Medium
Design: One of Wun, Gunna album cover, Move in Silence, and TR patch Specs
Finishing: White threading, Silver buttons and Truly Rare stamped lining on the interior', 125.00, '6773122', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Black, Red & White (CAU), S', '', 0.00, '', '{"default": 33}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Black, Red & White (CAU), M', '', 0.00, '', '{"default": 34}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Black, Red & White (CAU), L', '', 0.00, '', '{"default": 33}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Brown, & Yellow (HSSU), S', '', 0.00, '', '{"default": 33}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Brown, & Yellow (HSSU), M', '', 0.00, '', '{"default": 34}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Brown, & Yellow (HSSU), L', '', 0.00, '', '{"default": 33}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Green & Orange (FAMU), S', '', 0.00, '', '{"default": 33}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Green & Orange (FAMU), M', '', 0.00, '', '{"default": 34}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('One of Won HBCU jerseys Green & Orange (FAMU), L', '', 0.00, '', '{"default": 33}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Patch Project- Bob Marley Black Shorts Regular', 'Custom black denim shorts featuring bold, hand-stitched Bob Marley & The Wailers graphics. Distressed details meet reggae legend vibes—made for music lovers, creatives, and collectors who move different. 

Details:
	•	Size: XL
	•	Color: Black
	•	Upcycled & handmade
	•	Truly Rare Customs original
	•	Gentle wash only', 79.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Patch Project- King of Spades Regular', 'Command attention with these one-of-a-kind King of Spades Custom Cargo Shorts, a bold fusion of streetwear and storytelling. Upcycled military green cargos are reimagined with hand-placed playing card graphics, featuring a dual-faced king — one alive, one skeletal — symbolizing power, risk, and rebirth.

Accented with stitched red plaid crosses and patches, each detail adds texture, contrast, and raw character. No two pairs are alike — these shorts are sewn, patched, and distressed by hand, making them a wearable piece of art.

Size: XL
Fit: Relaxed / True to size
Care: Spot clean or hand wash to preserve detailing', 79.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Patch projects-Tupac x Harley M', 'These vintage denim shorts feature dope from flipped graphic tees Tupac, Harley, street legnds stitched into raw denim No mass production.Just Heat 

Fit✨ Size- Medium or 32 True to size 1 of 1 custom', 89.99, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Pearl Me out jacket Regular', '', 65.00, 'R392884', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Rare 2 Learn Regular', 'A stylish and interactive back 2 school pop up where families and young adults can:
Customize their notebooks or Tote bags
Get a feee hair cut or hygeine kit
Show custom & Sustainable gear
Enjoy music, games, and giveaways
Access free school supplies or resources
Connect with local creatives and entrepreneurs', 0.00, '1661809', '{"default": 0}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Reseal Patch Regular', 'Reinforces or replaces loose stitching on existing patches; includes cleanup and resewing', 8.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & Create: Paint the Track Regular', 'Our Sip & Creates are ALWAYS a Gaurenteed vibe but this one will be for the books! Join us for a night of painting, vinyl listening, and wine tasting all in one!
Bring a record to spin & get 30% OFF your ticket!

Wine tasting
Paint Session
Vinyl vibes ALL NIGHT 
4256 Manchester Ave', 40.00, 'P639238', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater S, Red', 'Celebrate 314 Day with a Slow Jam Sunday Sip & Paint session, hosted by Truly Rare Customs. This Sip & Paint ticket is for those who choose to take it up a notch and design their own DIY sweater. Included in this ticket you''ll receive a sweater, iron on patches, selection of htv transfers, unlimited wine, small bites and fun games you can win big on! 

Event details:
When: March 16th 2025
Time: 3-5pm
Where: 4256 Manchester Ave 63110', 60.00, '369021V', '{"default": 24}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater S, Black', '', 60.00, '2197440', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater S, White', '', 60.00, '9232508', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater S, Grey', '', 60.00, '4592712', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater S, Tan', '', 60.00, '7933351', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater M, Red', '', 60.00, '434270Z', '{"default": 13}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater M, Black', '', 60.00, '7635774', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater M, White', '', 60.00, 'X736222', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater M, Grey', '', 60.00, 'D616097', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater M, Tan', '', 60.00, 'A945782', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater L, Red', '', 60.00, '563861J', '{"default": 13}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater L, Black', '', 60.00, 'J067212', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater L, White', '', 60.00, 'J688663', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater L, Grey', '', 60.00, '496991R', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater L, Tan', '', 60.00, 'T578965', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater XL, Red', '', 60.00, '6888182', '{"default": 8}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater XL, Black', '', 60.00, 'W159171', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater XL, White', '', 60.00, 'D302101', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater XL, Grey', '', 60.00, '9726107', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater XL, Tan', '', 60.00, '281434C', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 2XL, Red', '', 60.00, '828110V', '{"default": 12}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 2XL, Black', '', 60.00, '302737J', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 2XL, White', '', 60.00, '914073Y', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 2XL, Grey', '', 60.00, 'H749382', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 2XL, Tan', '', 60.00, 'P339659', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 3XL, Red', '', 60.00, '983415C', '{"default": 12}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 3XL, Black', '', 60.00, '524093F', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 3XL, White', '', 60.00, 'L796136', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 3XL, Grey', '', 60.00, '230620A', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & DIY Sweater 3XL, Tan', '', 60.00, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Sip & Paint Regular', 'Celebrate 314 Day with a Slow Jam Sunday Sip & Paint session, hosted by Truly Rare Customs. This Sip & Paint ticket is for those who choose to paint on classic canvas boards instead of a Truly Rare Sweater. Included in this ticket you''ll receive a canvas board, paint kit, unlimited wine, small bites and fun games you can win big on!

Event details:
When: March 16th 2025
Time: 3-5pm
Where: 4256 Manchester Ave 63110', 35.00, '', '{"default": 13}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Small Biz Vendor Event Regular', 'Celebrate local businesses & entrepreneurs in your area!!!', 0.00, 'T905946', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Small Patch Regular', 'Basic sewing for small patches such as letters, mini logos, or symbols. Under 3""', 10.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Smokey Claw Shorts Regular', 'There ain''t your average denim. Distressed, hand-finised, and stamped with boldstreet icons made for the ones who move different.Each piece hits with raw edge energy and a no-rules vibe', 15.99, 'G740858', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Smokey Cor-Set 2pc Regular', '', 59.99, '851973H', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Smokey Corset Regular', '', 35.99, 'L002154', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Smokey Denim Cropped Tank Regular', 'Corset with twist. Dark denim rhinestone drip, and that bold lace-up front. Streetwear meets statement build to turn head, no apologies. size XL and short to', 25.99, 'W364795', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Smokey Short set Regular', 'top and bottom', 59.99, '648512X', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Smokey Shorts Regular', 'Vintage black denim, cuffed clean with light-catching rhinestone hits. Built for chill days and loud moves.Minimal,but it talks if you know how to listen', 25.99, '6477373', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Smokey- Pencil Skirt Regular', 'Thisdark-wash denim mimi skirt blends street style with subtle glam. It features crystal stud detailing, a raw-edge hem, and a single side pocket for a touch of utility. The high-waisted fit gives it a flattering silhouette perfect for pairing with oversize tee or cropped jacket there are in size small and they come top have', 29.99, '281519M', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Star Cut Set- Muscle Tee & Joggers Regular', 'Elevate your casual wear with the Star Cut Set, featuring a muscle tee and joggers designed for standout style. This matching set showcases a smokey grey and purple galaxy star pattern, accentuated by rhinestone detailing and a distressed finish. Perfect for lounging or a bold streetwear look, this set combines comfort with eye-catching design.', 89.99, '', '{"default": 1}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Star Cut- Muscle Tee Regular', 'Smokey grey star patch muscle tee shirt iscomfortable for everyday,workingg out or popping out. This XL shirt is a custom one of one featuring rhinestones and distress.', 35.99, 'J391460', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Star Cut- Wide leg Joggers Regular', 'Turn heads in these one-of-a-kind joggers that blend cosmic creativity with streetwear comfort. Handcrafted for those who dare to stand out, these black joggers feature hand-painted galaxy panels along each leg sewn-on star patches with rhinestone for that extra pop.

Fit✨

       •	Size: Large (unisex fit)
	•	Elastic waistband with drawstring
	•	One-of-one, never duplicated', 55.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Street Fighter Bag Regular', '', 0.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('TR Trucker Hats Red', 'Custom trucker hats come in either black or Red with plaid "TR" varsity patches and charms unique to each individual hat. All you choose is the color and wait for the final design to show up at your door, Truly Rare Stamped!', 20.00, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('TR Trucker Hats Black', '', 20.00, '970184N', '{"default": 3}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('The Jungle: Adam Regular', 'This retro jean jacket is a modern and artistic take on Tarzan with an eye-catching color pallet, amazing story and comfortable fit. On the front is a shimmering gold ""TR"" wrapped in vines that continue onto the pocket. The back is fully painted with an eclectic array of vibrant flowers and greenery almost as beautiful than the melanated man its hiding. This unisex jacket comes in a size Medium with a wool tan lining for an extra level of comfort.', 125.99, '7432506', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('The Jungle: Adam & Eve Regular', 'This Melanated Renaissance jacket is both eclectic and modern! The design features two beautiful women surrounded by gold and vibrant flowers in their natural state.', 125.99, '', '{"default": 1}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('The Standard- Mesh Dress Regular', 'This stunning mesh dress is nothing less than, ""The standard""! It features a black denim-breasted bodysuit underneath a handstitched textured ombre green draped dress. This one-of-one garment is intentionally crafted with light and airy fabric to inspire you to move and feel confident while doing so! With unique proportions and limitless style options, this garment will fit a size S(4-6) - M(8-10)!', 80.00, '', '{"default": 0}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Tote Bags Regular', '', 15.00, '', '{"default": 2}', 'no');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee S', 'The "Truly <em>HER</em>" Tee features a bold front graphic of lips flashing a grill iced out with actual gemstone prints spelling TRULY RARE. On the back, a powerful illustration of a woman with an unapologetic stance ties the whole design together — a nod to culture, individuality, and confidence.<br/><br><br/>Subtle yet elevated, the off-white colorway feels timeless and versatile. The slightly muted tone gives the gemstones and artwork a warmer, vintage-inspired finish while still keeping its modern streetwear edge.<br/><br><br/>Each shirt is made to order and customized after purchase. Please allow 5–7 business days for production before shipping or pickup.<br/><br><br/>✨ Details:<br/>	•	Premium 100% heavyweight cotton<br/>	•	Printed with high-definition artwork<br/>	•	Front: Gemstone "TRULY RARE" grills design<br/>	•	Back: Afro woman artwork with gold hoops &amp; jewelry details<br/>	•	Fits slightly oversized with a structured feel<br/>	•	Limited edition release<br/><br><br/>', 59.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee M', '', 59.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee L', '', 59.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee XL', '', 59.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee Kids Small', '', 39.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee Kids medium', '', 39.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee Kids large', '', 39.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee 2XL', '', 65.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Off White tee 3XL', '', 65.99, '', '{"default": 50}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee S', '<p><strong>Limited Edition - Pre Orders </strong></p><p><br></p><p>Streetwear meets sophistication. The olive green edition gives the design a rugged edge while maintaining a refined feel. The gemstones shine differently against this base, making it perfect for those who like their style versatile but never ordinary.</p><p><br></p><p>Each shirt is made to order and customized after purchase. Please allow 5–7 business days for production before shipping or pickup.</p><p><br></p><p><br></p><p>✨ Details:</p><p>	•	Premium 100% heavyweight cotton</p><p>	•	Printed with high-definition artwork</p><p>	•	Front: Gemstone "TRULY RARE" grills design</p><p>	•	Back: Afro woman artwork with gold hoops &amp; jewelry details</p><p>	•	Fits oversized with a structured feel</p><p>	•	Limited edition release</p>', 59.99, 'Q01051', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee M', '', 59.99, '588000M', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee L', '', 59.99, '934444L', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee XL', '', 59.99, '933107L', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee Kids Small', '', 39.99, 'P867752', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee Kids medium', '', 39.99, '5679960', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee Kids large', '', 39.99, '674183Z', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee 2XL', '', 65.99, '584082Q', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Olive Green Tee 3XL', '', 65.99, '453708H', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee S', '<p>Pre Orders + In store Limited edition </p><p><br></p><p>Bold and raw, the rustic orange tee brings a fiery street energy. It''s the perfect backdrop for the gemstone grills, giving them an earthy contrast that feels both vibrant and grounded. This colorway carries the most attitude — built for the ones who lead, not follow.</p><p><br></p><p>Crafted from premium, heavyweight cotton, this tee offers both comfort and durability while still being breathable. Designed to stand the test of time, this isn''t just a shirt — it''s a statement piece.</p><p><br></p><p>Each shirt is made to order and customized after purchase. Please allow 5–7 business days for production before shipping or pickup.</p><p><br></p><p><strong>✨ Details:</strong></p><p><strong>	•	Premium 100% heavyweight cotton</strong></p><p><strong>	•	Printed with high-definition artwork</strong></p><p><strong>	•	Front: Gemstone "TRULY RARE" grills design</strong></p><p><strong>	•	Back: Afro woman artwork with gold hoops &amp; jewelry details</strong></p><p><strong>	•	Fits oversized with a structured feel</strong></p><p><strong>	•	Limited edition release</strong></p><p><br></p><p><br></p>', 59.99, '6486217', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee M', '', 59.99, 'Q940663', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee L', '', 59.99, '162601Z', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee XL', '', 59.99, 'Q796102', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee Kids Small', '', 39.99, '597698D', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee Kids medium', '', 39.99, '3408186', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee Kids large', '', 39.99, 'R601205', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee 2XL', '', 65.99, 'B191655', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- Rustic Orange Tee 3XL', '', 65.99, '772272C', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees S', '<p><strong>Pre Orders + In store Limited edition</strong></p><p>Make your outfit speak before you do with our Truly Her Custom Tee — a unisex statement piece built for anyone who carries confidence with ease. Each shirt features a hand-drawn lip design with Truly Rare across the teeth, finished with individually placed rhinestones for that signature Truly Rare shine.</p><p><br></p><p>Printed on a loose-fit, 100% cotton tee, this design gives you breathable comfort with an artsy edge. Whether styled oversized, fitted, layered, or street-ready, this piece brings personality and attitude to any look.</p><p><br></p><p>Every tee is crafted in-house at Truly Rare Customs — no mass production, just real artistry and real hands behind every detail.</p><p><br></p><p><strong>Features</strong></p><p><br></p><ul><li>Unisex loose-fit 100% cotton tee</li><li>Hand-drawn custom artwork featuring the Truly Her lip graphic</li><li>Rhinestone detailing for depth + shine</li><li>Durable, vibrant print</li><li>Available in olive green, copper orange, off-white, and white</li><li>Custom-made by Truly Rare Customs — unique, art-driven, and intentionally crafted</li></ul><p><br></p><p><br></p><p><br></p><p><strong>Details:</strong></p><ul><li>🎨 Custom + handcrafted</li><li>✂️ Unisex oversized fit</li><li>📦 Ships in 5–7 days (rush available)</li></ul><p><br></p>', 59.99, 'V581009', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees M', '', 59.99, 'Z213924', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees L', '', 59.99, '600699M', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees XL', '', 59.99, '9980155', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees Kids Small', '', 39.99, 'A284611', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees Kids medium', '', 39.99, '208469P', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees Kids large', '', 39.99, 'T240938', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees 2XL', '', 65.99, '9523183', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Her- White Tees 3XL', '', 65.99, '275936B', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rare land Set Grey, Pink', 'Discover the exceptional craftsmanship of TrulyRareland''s set, featuring unique designs meticulously crafted from high-quality materials. Each piece is a limited edition, ensuring exclusivity and a touch of luxury to your collection. Elevate your style with TrulyRareland''s exquisite set today.', 75.00, 'S352653', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rare land Set Grey, White', '', 75.00, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rare land Set Black, Pink', '', 75.00, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rare land Set Black, White', '', 75.00, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) S, Pink, Grey', 'This unisex classic mid-weight hoodie features the bold ""Truly Rare"" graphic across the chest, complemented by a vibrant universe design on the back. With its comfortable, relaxed fit, it''s perfect for everyday wear. The hoodie comes equipped with a 3-panel hood, a kangaroo pocket for convenience, and ribbed cuffs and waistband for a snug yet flexible feel.

Crafted from premium 3-end fleece, this hoodie is incredibly soft and cozy, offering ultimate comfort all day long. Plus, it''s made of 100% cotton with under 5% shrinkage, so you can wash it as often as you like with no worries!', 25.99, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) S, Pink, Black', '', 25.99, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) S, White, Grey', '', 25.99, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) S, White, Black', '', 25.99, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) M, Pink, Grey', '', 25.99, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) M, Pink, Black', '', 25.99, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) M, White, Grey', '', 25.99, '', '{"default": 3}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) M, White, Black', '', 25.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) L, Pink, Grey', '', 25.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) L, Pink, Black', '', 25.99, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) L, White, Grey', '', 25.99, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) L, White, Black', '', 25.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) XL, Pink, Grey', '', 25.99, '', '{"default": 3}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) XL, Pink, Black', '', 25.99, '', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) XL, White, Grey', '', 25.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (pink) XL, White, Black', '', 25.99, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (white) S', 'This unisex classic mid-weight hoodie features the bold ""Truly Rare"" graphic across the chest, complemented by a vibrant universe design on the back. With its comfortable, relaxed fit, it''s perfect for everyday wear. The hoodie comes equipped with a 3-panel hood, a kangaroo pocket for convenience, and ribbed cuffs and waistband for a snug yet flexible feel.

Crafted from premium 3-end fleece, this hoodie is incredibly soft and cozy, offering ultimate comfort all day long. Plus, it''s made of 100% cotton with under 5% shrinkage, so you can wash it as often as you like with no worries!', 25.99, '826345Y', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (white) M', '', 25.99, 'N557722', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (white) L', '', 25.99, '6824564', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (white) XL', '', 25.99, 'E627345', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (white) 2XL', '', 25.99, 'S344945', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Black (white) 3XL', '', 25.99, '719883R', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) S', 'Experience the epitome of luxury with the Truly Rareland Hoodie in Grey and Pink. Crafted from premium quality materials, this hoodie boasts a unique color combination that sets it apart. The modern design of this hoodie exudes sophistication and style, making it a must-have piece for your wardrobe.', 25.99, '844252S', '{"default": 23}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) M', '', 25.99, '600519L', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) L', '', 25.99, '9202343', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) XL', '', 25.99, '2857232', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) Kids Small', '', 25.99, '260070X', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) Kids medium', '', 25.99, '142216H', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) Kids large', '', 25.99, '2714727', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) 2XL', '', 25.99, '944842L', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (Pink) 3XL', '', 25.99, '289047J', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (White) S', 'This unisex classic mid-weight hoodie features the bold ""Truly Rare"" graphic across the chest, complemented by a vibrant universe design on the back. With its comfortable, relaxed fit, it''s perfect for everyday wear. The hoodie comes equipped with a 3-panel hood, a kangaroo pocket for convenience, and ribbed cuffs and waistband for a snug yet flexible feel.

Crafted from premium 3-end fleece, this hoodie is incredibly soft and cozy, offering ultimate comfort all day long. Plus, it''s made of 100% cotton with under 5% shrinkage, so you can wash it as often as you like with no worries!', 25.99, '126945L', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (White) M', '', 25.99, 'J284940', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (White) L', '', 25.99, 'H218827', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (White) XL', '', 25.99, '926104R', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (White) 2XL', '', 25.99, '254441Z', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Hoodie Grey (White) 3XL', '', 25.99, 'H275363', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers S, Grey', '', 35.00, '', '{"default": 4}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers S, Black', '', 35.00, '', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers M, Grey', '', 35.00, '', '{"default": 3}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers M, Black', '', 35.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers L, Grey', '', 35.00, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers L, Black', '', 35.00, '', '{"default": 5}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers XL, Grey', '', 35.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland Joggers XL, Black', '', 35.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland-Rhinestone sleeves Regular', 'Truly Rareland but make it shine…. Cop our classic universe drawstring hoodie featuring various sized rhinestones on the sleeves. These stones make our light pink stable logo pop like no other.', 35.99, 'H583359', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland-Rhinestone sleeves (1) S', '<p><strong>Level up your casual game with the &#34;Rare Gem&#34; Hoodie – where comfort meets custom drip.</strong></p><p>This isn''t your average gray pullover. It''s built for those low-key flex days. We started with a premium, heavy-blend <strong>charcoal grey hoodie</strong> and hit it with that signature <strong>Truly Rare</strong> touch.</p><ul><li><strong>The Vibe:</strong> Chill, exclusive, and instantly eye-catching.</li><li><strong>Front Detail:</strong> Features the iconic <strong>&#34;Truly Rare&#34; logo</strong> across the chest in a striking <strong>pink script</strong> that pops hard against the grey.</li><li><strong>Icy Sleeves:</strong> Both sleeves are studded with <strong>hand-placed rhinestones/stones</strong> (choose the best descriptor: <strong>pink rhinestones</strong>, <strong>scattered stones</strong>) in various sizes, giving you a subtle, unmatched sparkle and depth. No two hoodies are exactly alike!</li><li><strong>Fit:</strong> Relaxed, cozy fit perfect for layering over tees or wearing on its own.</li></ul><p><strong>Grab this limited drop and prove you''re truly rare.</strong></p>', 54.99, '607682G', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland-Rhinestone sleeves (1) M', '', 54.99, 'V166288', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland-Rhinestone sleeves (1) L', '', 54.99, '694845E', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland-Rhinestone sleeves (1) XL', '', 54.99, '549689Q', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland-Rhinestone sleeves (1) 2XL', '', 54.99, 'H049019', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly Rareland-Rhinestone sleeves (1) 3XL', '', 54.99, '1175928', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Long Sleeve Tee S', 'Experience the perfect blend of comfort and style with the Truly STL Tee. Crafted for a comfortable fit and featuring a stylish design, this tee is a versatile addition to your wardrobe. This tee is a must-have for those who appreciate both fashion and comfort!', 25.99, '443779H', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Long Sleeve Tee M', '', 25.99, 'S785610', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Long Sleeve Tee L', '', 25.99, '877509T', '{"default": 2}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Long Sleeve Tee XL', '', 25.99, 'B438380', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Ultra Soft Hoodie S', 'Experience the perfect blend of comfort and style with the Truly STL Hoodie. Crafted for a comfortable fit and featuring a stylish design, this tee is a versatile addition to your wardrobe. Available in a range of color options, this tee is a must-have for those who appreciate both fashion and comfort.', 60.00, 'X104321', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Ultra Soft Hoodie M', '', 60.00, '451552C', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Ultra Soft Hoodie L', '', 60.00, 'T098513', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Truly STL Ultra Soft Hoodie XL', '', 60.00, '957371S', '{"default": 1}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('VIP Canvas Insider Regular', 'As a Truly Rare Insider, you''re not just shopping the brand — you''re part of the brand.<br/><br><br/>Your membership unlocks:<br/><br><br/><ul><li>🚀 First Access to Drops – shop every new collection before the public.</li><li>👕 Quarterly Free T-Shirt – four exclusive tees a year, on the house.</li><li>🎟️ Event Perks – discounts on Truly Rare events all year long + 1 free event entry every year.</li><li>💎 Exclusive VIP Deals – secret pricing and offers that never hit the main site.</li><li>🎂 Birthday Gift – celebrate your day with Rare love and perks.</li><li>🔒 Behind-the-Scenes Access – sneak peeks, styling inspo, and inside looks only Insiders get.</li></ul><br><br/><br><br/>For the ones who live rare, this membership pays for itself and then some. Tap in, lock your spot, and never miss a drop again.<br/><br/><br/>', 25.00, '996724W', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('Water Me Set', 'A Truly Rare black leather set, handmade for a Fashion ICON! This two-piece set comes with a sleek tie-up corset ft. vibrant flower enhancements that trail on the side of the skirt. The midi-sized fitted pencil skirt has a classy yet sexy split in the center. Crafting the perfect fit and for sizes S(4-6) - M(8-10)!', 50.00, '', '{"default": 0}', 'yes');
INSERT INTO products (name, description, price, sku, stock, visible) VALUES ('consultation Regular', '', 0.00, 'S047807', '{"default": 0}', 'no');
