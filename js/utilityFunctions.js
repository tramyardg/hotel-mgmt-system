class UtilityFunctions {
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
}
