class UtilityFunctions {
  constructor () {
    console.log('utilityFunctions.js');
    this.regexReservedWords = /\b(ADD|ALTER|AND|AS|BETWEEN|BY|CASE|CREATE|DELETE|DESC|DISTINCT|DROP|EXISTS|FROM|GROUP|HAVING|IN|INSERT|INTO|IS|JOIN|LIKE|LIMIT|NOT|NULL|OR|ORDER|SELECT|SET|TABLE|UPDATE|VALUES|WHERE)\b/gmi;
    // Alternative syntax using RegExp constructor
    // const regex = new RegExp('\\b(ADD|ALTER|AND|AS|BETWEEN|BY|CASE|CREATE|DELETE|DESC|DISTINCT|DROP|EXISTS|FROM|GROUP|HAVING|IN|INSERT|INTO|IS|JOIN|LIKE|LIMIT|NOT|NULL|OR|ORDER|SELECT|SET|TABLE|UPDATE|VALUES|WHERE)\\b', 'gmi')
  }

  /**
   * Get the difference in days between two date objects.
   * Example: const a = new Date("2017-01-01"), b = new Date("2017-07-25"),
   * difference = dateDiffInDays(a, b);
   * @param dateA
   * @param dateB
   * @returns {number}
   */
  dateDiffInDays (dateA, dateB) {
    const _MS_PER_DAY = 1000 * 60 * 60 * 24;
    const utcA = Date.UTC(dateA.getFullYear(), dateA.getMonth(), dateA.getDate());
    const utcB = Date.UTC(dateB.getFullYear(), dateB.getMonth(), dateB.getDate());
    return Math.floor((utcB - utcA) / _MS_PER_DAY);
  }

  findMatchReservedWords (str) {
    let m;
    let foundMatch = false;

    while ((m = this.regexReservedWords.exec(str)) !== null) {
      // This is necessary to avoid infinite loops with zero-width matches
      if (m.index === this.regexReservedWords.lastIndex) {
        this.regexReservedWords.lastIndex++;
      }

      // The result can be accessed through the `m`-variable.
      for (let i = 0; i < m.length; i++) {
        // const match = m[i];
        // console.log(`Found match, group ${i}: ${match}`);
        foundMatch = true;
        break;
      }
    }
    return foundMatch;
  };

  setCookie (name, value, days) {
    var expires = '';
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
  }

  getCookie (cName) {
    const name = cName + '=';
    const cDecoded = decodeURIComponent(document.cookie);
    const cArr = cDecoded.split('; ');
    let res;
    cArr.forEach(val => {
      if (val.indexOf(name) === 0) res = val.substring(name.length);
    });
    return res;
  }

  eraseCookie (name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }

  checkCookieExists (cookieName) {
    let cookies = document.cookie.split(';');
    let isCookieExists = false;
    for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i].trim();
      if (cookie.indexOf(cookieName + '=') === 0) {
        isCookieExists = true;
        break;
      }
    }
    return isCookieExists;
  }
}

window.UtilityFunctions = UtilityFunctions;
