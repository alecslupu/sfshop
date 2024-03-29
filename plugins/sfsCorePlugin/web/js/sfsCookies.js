var sfs = sfs || {};
Object.extend( sfs || {}, 
{
    Cookies: Class.create(
    {
        initialize: function(path, domain) {
            this.path = path || '/';
            this.domain = domain || null;
        },
        set: function(key, value, days) {
            if (typeof key != 'string') {
                throw "Invalid key";
            }
            if (typeof value != 'string' && typeof value != 'number') {
                throw "Invalid value";
            }
            if (days && typeof days != 'number') {
                throw "Invalid expiration time";
            }
            var setValue = key+'='+escape(new String(value));
            if (days) {
                var date = new Date();
                date.setTime(date.getTime()+(days*24*60*60*1000));
                var setExpiration = "; expires="+date.toGMTString();
            } else var setExpiration = "";
            var setPath = '; path='+escape(this.path);
            var setDomain = (this.domain) ? '; domain='+escape(this.domain) : '';
            var cookieString = setValue+setExpiration+setPath+setDomain;
            document.cookie = cookieString;
        },
        get: function(key) {
            var keyEquals = key+"=";
            var value = false;
            document.cookie.split(';').invoke('strip').each(function(s){
                if (s.startsWith(keyEquals)) {
                    value = unescape(s.substring(keyEquals.length, s.length));
                    throw $break;
                }
            });
            return value;
        },
        clear: function(key) {
            this.set(key,'',-1);
        },
        clearAll: function() {
            document.cookie.split(';').collect(function(s){
                return s.split('=').first().strip();
            }).each(function(key){
                this.clear(key);
            }.bind(this));
        }
    })
});