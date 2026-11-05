
/*
 * Name : TweeCool
 * version: 1.9 
 * Description: Get the latest tweets from twitter.
 * Website: www.tweecool.com
 * Licence: No licence, feel free to do whatever you want.
 * Author: TweeCool
 */

"use strict";
(function ($) {
    $.fn.extend({

        tweecool: function (options) {

            var defaults = {
                username: 'tweecool',
                limit: 5,
                profile_image: true,
                show_time: true,
                show_media: false,
                show_media_size: 'thumb',  //values: small, large, thumb, medium 
                show_actions: false,
                action_reply_icon: '&crarr;',
                action_retweet_icon: '&prop;',
                action_favorite_icon: '&#10084',
                profile_img_url: 'profile', //Values: profile, tweet 
                show_retweeted_text: false //This will show the original tweet in order to avoid any truncated text, and also the "RT @tweecool:" is removed which helps with 140 character limit

            }

            var options = $.extend(defaults, options);

            function xTimeAgo(time) {
                var nd = new Date();
                //var gmtDate = Date.UTC(nd.getFullYear(), nd.getMonth(), nd.getDate(), nd.getHours(), nd.getMinutes(), nd.getMilliseconds());
                var gmtDate = Date.parse(nd);
                var tweetedTime = time * 1000; //convert seconds to milliseconds
                var timeDiff = (gmtDate - tweetedTime) / 1000; //convert milliseconds to seconds

                var second = 1, minute = 60, hour = 60 * 60, day = 60 * 60 * 24, week = 60 * 60 * 24 * 7, month = 60 * 60 * 24 * 30, year = 60 * 60 * 24 * 365;

                if (timeDiff > second && timeDiff < minute) {
                    return Math.round(timeDiff / second) + " second" + (Math.round(timeDiff / second) > 1 ? 's' : '') + " ago";
                } else if (timeDiff >= minute && timeDiff < hour) {
                    return Math.round(timeDiff / minute) + " minute" + (Math.round(timeDiff / minute) > 1 ? 's' : '') + " ago";
                } else if (timeDiff >= hour && timeDiff < day) {
                    return Math.round(timeDiff / hour) + " hour" + (Math.round(timeDiff / hour) > 1 ? 's' : '') + " ago";
                } else if (timeDiff >= day && timeDiff < week) {
                    return Math.round(timeDiff / day) + " day" + (Math.round(timeDiff / day) > 1 ? 's' : '') + " ago";
                } else if (timeDiff >= week && timeDiff < month) {
                    return Math.round(timeDiff / week) + " week" + (Math.round(timeDiff / week) > 1 ? 's' : '') + " ago";
                } else if (timeDiff >= month && timeDiff < year) {
                    return Math.round(timeDiff / month) + " month" + (Math.round(timeDiff / month) > 1 ? 's' : '') + " ago";
                } else {
                    return 'over a year ago';
                }
            }

            return this.each(function () {
                var o = options;
                var wrapper = $(this);
                var wInner = $('<ul>').appendTo(wrapper);
                var urlpattern = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
                var usernamepattern = /@+(\w+)/ig;
                var hashpattern = /#+(\w+)/ig;
                var pIMG, media, timestamp, abox, mtext;

                $.getJSON("http://tweecool.com/api/?screenname=" + o.username + "&count=" + o.limit, function (data) {

                    if (data.errors || data == null) {
                        wrapper.html('No tweets available.');
                        return false;
                    }

                    $.each(data.tweets, function (i, field) {

                        if (o.profile_image) {
                            if (o.profile_img_url == 'tweet') {
                                pIMG = '<a href="https://twitter.com/' + o.username + '/status/' + field.id_str + '" target="_blank"><img src="' + data.user.profile_image_url + '" alt="' + o.username + '" /></a>';
                            } else {
                                pIMG = '<a href="https://twitter.com/' + o.username + '" target="_blank"><img src="' + data.user.profile_image_url + '" alt="' + o.username + '" /></a>';
                            }
                        } else {
                            pIMG = '';
                        }

                        if (o.show_time) {
                            timestamp = xTimeAgo(field.timestamp);
                        } else {
                            timestamp = '';
                        }

                        if (o.show_media && field.media_url) {
                            media = '<a href="https://twitter.com/' + o.username + '/status/' + field.id_str + '" target="_blank"><img src="' + field.media_url + ':' + o.show_media_size + '" alt="' + o.username + '" class="media" /></a>';
                        } else {
                            media = '';
                        }

                        if (o.show_actions) {
                            abox = '<div class="action-box"><ul>';
                            abox += '<li class="ab_reply"><a title="Reply" href="https://twitter.com/intent/tweet?in_reply_to=' + field.id_str + '">' + o.action_reply_icon + '</a></li>';
                            abox += '<li class="ab_retweet"><a title="Retweet" href="https://twitter.com/intent/retweet?tweet_id=' + field.id_str + '">' + o.action_retweet_icon + '</a>' + (field.retweet_count_f != '' ? '<span>' + field.retweet_count_f + '</span>' : '') + '</li>';
                            abox += '<li class="ab_favorite"><a title="Favorite" href="https://twitter.com/intent/favorite?tweet_id=' + field.id_str + '">' + o.action_favorite_icon + '</a>' + (field.favorite_count_f != '' ? '<span>' + field.favorite_count_f + '</span>' : '') + '</li>';
                            abox += '</ul></div>';
                        } else {
                            abox = '';
                        }

                        if (o.show_retweeted_text && field.retweeted_text) {
                            mtext = field.retweeted_text;
                        } else {
                            mtext = field.text;
                        }

                        wInner.append('<li>' + pIMG + '<div class="tweets_txt">' + mtext.replace(urlpattern, '<a href="$1" target="_blank">$1</a>').replace(usernamepattern, '<a href="https://twitter.com/$1" target="_blank">@$1</a>').replace(hashpattern, '<a href="https://twitter.com/search?q=%23$1" target="_blank">#$1</a>') + media + ' <span>' + timestamp + '</span>' + abox + '</div></li>');
                    });

                }).fail(function (jqxhr, textStatus, error) {
                    //var err = textStatus + ', ' + error;
                    wrapper.html('No tweets available');
                });

            });

        }
    });

})(jQuery);

/*
 * Facebook Wall
 * https://github.com/thomasclausen/jquery-facebook-wall
 * Under MIT License
 */
! function (e) {
    e.fn.facebook_wall = function (t) {
        function s(e) {
            return a(i(l(e)))
        }

        function a(e) {
            return e.replace(/(\r\n)|(\n\r)|\r|\n/g, "<br />")
        }

        function i(e) {
            return e.replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1" target="_blank">$1</a>')
        }

        function l(e) {
            return e.replace(/</g, "&lt;").replace(/>/g, "&gt;")
        }

        function n(e) {
            var s = new Date(1e3 * e),
                a = (s.toGMTString(), Math.round((new Date).getTime() / 1e3) - e);
            return a < 10 ? t.text_labels.seconds.few : a < 60 ? Math.round(a) + t.text_labels.seconds.plural : 1 === Math.round(a / 60) ? Math.round(a / 60) + t.text_labels.minutes.singular : Math.round(a / 60) < 60 ? Math.round(a / 60) + t.text_labels.minutes.plural : 1 === Math.round(a / 3600) ? Math.round(a / 3600) + t.text_labels.hours.singular : Math.round(a / 3600) < 24 ? Math.round(a / 3600) + t.text_labels.hours.plural : 1 === Math.round(a / 86400) ? Math.round(a / 86400) + t.text_labels.days.singular : Math.round(a / 86400) <= 10 ? Math.round(a / 86400) + t.text_labels.days.plural : t.text_labels.weekdays[s.getDay()] + " " + s.getDate() + ". " + t.text_labels.months[s.getMonth()] + " " + s.getFullYear()
        }
        if (void 0 !== t.id && void 0 !== t.access_token) {
            var o = "https://graph.facebook.com/",
                r = (t = e.extend({
                    id: "",
                    access_token: "",
                    limit: 15,
                    timeout: 400,
                    speed: 400,
                    effect: "slide",
                    locale: "en_US",
                    avatar_size: "square",
                    message_length: 200,
                    comments: !0,
                    show_guest_entries: !0,
                    text_labels: {
                        shares: {
                            singular: "Shared % time",
                            plural: "Shared % times"
                        },
                        likes: {
                            singular: "% Like",
                            plural: "% Likes"
                        },
                        comments: {
                            singular: "% comment",
                            plural: "% comments"
                        },
                        like: "Like",
                        comment: "Write comment",
                        share: "Share",
                        weekdays: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                        months: ["januari", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"],
                        seconds: {
                            few: "second ago",
                            plural: " seconds ago"
                        },
                        minutes: {
                            singular: " minut ago",
                            plural: " minutes ago"
                        },
                        hours: {
                            singular: " hour ago",
                            plural: " hours ago"
                        },
                        days: {
                            singular: " day ago",
                            plural: " days ago"
                        }
                    },
                    on_complete: null
                }, t)).comments ? "comments," : "",
                d = o + "v2.9/" + t.id + "/?access_token=" + t.access_token + "&locale=" + t.locale + "&date_format=U&fields=posts.limit(" + t.limit + "){caption,message,picture,from,link,source,properties,icon,actions,is_hidden,is_expired,likes," + r + "shares,status_type,object_id,created_time,updated_time,type}",
                c = e(this);
            c.append('<div class="feeds-loading facebook-loading"></div>'), e.getJSON(d, function (a) {
                e.each(a.posts.data, function () {
                    var e = "",
                        a = "",
                        i = "";
                    if (!1 === this.is_hidden) {
                        if ("link" === this.type ? a = "type-link " : "photo" === this.type ? a = "type-photo " : "status" === this.type ? a = "type-status " : "video" === this.type && (a = "type-video "), e += '<li class="post ' + a + "avatar-size-" + t.avatar_size + '">', e += '<div class="meta-header">', e += '<div class="avatar"><a href="http://www.facebook.com/profile.php?id=' + this.from.id + '" target="_blank" title="' + this.from.name + '"><img src="' + (o + this.from.id) + "/picture?type=" + t.avatar_size + '" alt="' + this.from.name + '" /></a></div>', e += '<div class="author"><a href="http://www.facebook.com/profile.php?id=' + this.from.id + '" target="_blank" title="' + this.from.name + '">' + this.from.name + "</a></div>", e += '<div class="date">' + n(this.created_time) + "</div>", e += "</div>", void 0 !== this.message ? t.message_length > 0 && this.message.length > t.message_length ? e += '<div class="message">' + s(this.message.substring(0, t.message_length)) + "...</div>" : e += '<div class="message">' + s(this.message) + "</div>" : void 0 !== this.story && (t.message_length > 0 && this.story.length > t.message_length ? e += '<div class="story">' + s(this.story.substring(0, t.message_length)) + "...</div>" : e += '<div class="story">' + s(this.story) + "</div>"), "link" !== this.type && "photo" !== this.type && "video" !== this.type || (e += '<div class="media' + (void 0 !== this.picture || void 0 !== this.object_id ? " border-left" : "") + ' clearfix">', void 0 !== this.picture ? e += '<div class="image"><a href="' + this.link + '" target="_blank"><img src="' + this.picture + '" /></a></div>' : void 0 !== this.object_id && (e += '<div class="image"><a href="' + this.link + '" target="_blank"><img src="' + (o + this.object_id) + '/picture?type=album" /></a></div>'), e += '<div class="media-meta">', void 0 !== this.name && (e += '<div class="name"><a href="' + this.link + '" target="_blank">' + this.name + "</a></div>"), void 0 !== this.caption && (e += '<div class="caption">' + s(this.caption) + "</div>"), void 0 !== this.description && (e += '<div class="description">' + s(this.description) + "</div>"), e += "</div>", e += "</div>"), e += '<div class="meta-footer">', e += '<time class="date" datetime="' + this.created_time + '" pubdate>' + n(this.created_time) + "</time>", void 0 !== this.likes && void 0 !== this.likes.data && (void 0 !== this.likes.count ? 1 === this.likes.count ? e += '<span class="seperator">&middot;</span><span class="likes">' + t.text_labels.likes.singular.replace("%", this.likes.count) + "</span>" : e += '<span class="seperator">&middot;</span><span class="likes">' + t.text_labels.likes.plural.replace("%", this.likes.count) + "</span>" : 1 === this.likes.data.length ? e += '<span class="seperator">&middot;</span><span class="likes">' + t.text_labels.likes.singular.replace("%", this.likes.data.length) + "</span>" : e += '<span class="seperator">&middot;</span><span class="likes">' + t.text_labels.likes.plural.replace("%", this.likes.data.length) + "</span>"), void 0 !== this.comments && void 0 !== this.comments.data && (1 === this.comments.data.length ? e += '<span class="seperator">&middot;</span><span class="comments">' + t.text_labels.comments.singular.replace("%", this.comments.data.length) + "</span>" : e += '<span class="seperator">&middot;</span><span class="comments">' + t.text_labels.comments.plural.replace("%", this.comments.data.length) + "</span>"), void 0 !== this.shares ? 1 === this.shares.count ? e += '<span class="seperator">&middot;</span><span class="shares">' + t.text_labels.shares.singular.replace("%", this.shares.count) + "</span>" : e += '<span class="seperator">&middot;</span><span class="shares">' + t.text_labels.shares.plural.replace("%", this.shares.count) + "</span>" : e += '<span class="seperator">&middot;</span><span class="shares">' + t.text_labels.shares.plural.replace("%", "0") + "</span>", i = this.id.split("_"), e += '<div class="actionlinks"><span class="like"><a href="http://www.facebook.com/permalink.php?story_fbid=' + i[1] + "&id=" + i[0] + '" target="_blank">' + t.text_labels.like + '</a></span><span class="seperator">&middot;</span><span class="comment"><a href="http://www.facebook.com/permalink.php?story_fbid=' + i[1] + "&id=" + i[0] + '" target="_blank">' + t.text_labels.comment + '</a></span><span class="seperator">&middot;</span><span class="share"><a href="http://www.facebook.com/permalink.php?story_fbid=' + i[1] + "&id=" + i[0] + '" target="_blank">' + t.text_labels.share + "</a></span></div>", e += "</div>", void 0 !== this.likes && void 0 !== this.likes.data) {
                            e += '<ul class="like-list">';
                            for (var l = 0; l < this.likes.data.length; l++) e += '<li class="like">', e += '<div class="meta-header">', e += '<div class="avatar"><a href="http://www.facebook.com/profile.php?id=' + this.likes.data[l].id + '" target="_blank" title="' + this.likes.data[l].name + '"><img src="' + (o + this.likes.data[l].id) + "/picture?type=" + t.avatar_size + '" alt="' + this.likes.data[l].name + '" /></a></div>', e += '<div class="author"><a href="http://www.facebook.com/profile.php?id=' + this.likes.data[l].id + '" target="_blank" title="' + this.likes.data[l].name + '">' + this.likes.data[l].name + "</a>" + t.text_labels.likes.singular.replace("%", "") + "</div>", e += "</div>", e += "</li>";
                            e += "</ul>"
                        }
                        if (void 0 !== this.comments && void 0 !== this.comments.data) {
                            e += '<ul class="comment-list">';
                            for (var r = 0; r < this.comments.data.length; r++)
                                e += '<li class="comment">', e += '<div class="message">' + s(this.comments.data[r].message) + "</div>", e += '<time class="date" datetime="' + this.comments.data[r].created_time + '" pubdate>' + n(this.comments.data[r].created_time) + "</time>", e += "</li>";
                            e += "</ul>"
                        }
                        e += "</li>", c.append(e)
                    }
                })
            }).done(function () {
                e(".facebook-loading", c).fadeOut(800, function () {
                    e(this).remove();
                    for (var s = 0; s < c.children("li").length; s++) "none" === t.effect ? c.children("li").eq(s).show() : "fade" === t.effect ? c.children("li").eq(s).delay(s * t.timeout).fadeIn(t.speed) : c.children("li").eq(s).delay(s * t.timeout).slideDown(t.speed, function () {
                        e(this).css("overflow", "visible")
                    })
                }), e.isFunction(t.on_complete) && t.on_complete.call()
            })
        }
    }
}(jQuery);

/*
* ===========================================================
* SOCIAL STREAM - FRAMEWORK Y
* ===========================================================
* Social stream of Facebook and Twitter, this script have 4 display types: simple list, scroll box container, slider and carousel
* The script require Flexslider for slider and carousel display type and Scroll box for scroll box display type
* Documentation: www.framework-y.com/components/social.html
* 
* Schiocco - Copyright (c) Federico Schiocchet - Schiocco - Framework Y
*/

var facebook_token = "468579063493515|vbOM4x_ROvDmC_03g3iI-KXqYA0";
(function ($) {
    $(document).ready(function () {
        $("*[data-social-id].social-feed-fb").each(function () {
            var t = this;
            var count = 4;
            var optionsString = $(t).attr("data-options");
            var id = $(t).attr("data-social-id");
            var token = $(t).attr("data-token");
            if (isEmpty(token)) token = facebook_token;
            var optionsArr;
            var options = {
                access_token: token,
                limit: count,
                locale: "en_US",
                show_guest_entries: false
            }

            if (!isEmpty(optionsString)) {
                optionsArr = optionsString.split(",");
                options = getOptionsString(optionsString, options);
            }

            if (!isEmpty(id)) options["id"] = id;
            $(t).facebook_wall(options);

            if ($(t).hasClass("flexslider")) {
                var timerVar;
                timerVar = self.setInterval(function () {
                    if ($(t).find('li.post').length == options["limit"] && $(t).find('.facebook-loading').length == 0) {
                        $(t).html("<ul class='slides'>" + $(t).html() + "</ul>");


                        $(t).find("li").each(function (index) {
                            $(this).html("<div class='fb-container'>" + $(this).html() + '</div>');

                        });

                        if (isEmpty($(t).attr("data-trigger"))) $(t).initFlexSlider();
                        $(t).css("opacity", 1);
                        clearInterval(timerVar);
                    }
                }, 1000);
            }
        });

        $("*[data-social-id].social-feed-tw").each(function () {
            var t = this;
            var optionsString = $(t).attr("data-options");
            var id = $(t).attr("data-social-id");
            var optionsArr;
            var options = {
                limit: 4,
                show_media: true
            }

            if (!isEmpty(optionsString)) {
                optionsArr = optionsString.split(",");
                options = getOptionsString(optionsString, options);
            }

            if (!isEmpty(id)) options["username"] = id;
            $(t).tweecool(options);

            if ($(t).hasClass("flexslider")) {
                var timerVar;
                timerVar = self.setInterval(function () {
                    if ($(t).find('ul li').length) {
                        if (isEmpty($(t).attr("data-trigger"))) $(t).initFlexSlider();
                        clearInterval(timerVar);
                    }
                }, 1300);
            }
        });
    });
}(jQuery));


