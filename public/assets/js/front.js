function scrollContainer(containerId, direction) {
    const container = document.getElementById(containerId);
    const scrollAmount = 300;

    // التصحيح:
    // في العربية RTL: "Right" يعني البداية (يسار منطقياً عند التمرير)
    // و "Left" يعني النهاية (يمين منطقياً عند التمرير)
    // لكن scrollBy تعتمد على إحداثيات الشاشة الفيزيائية.

    // للتوضيح للمستخدم:
    // الضغط على السهم الأيمن (>) يريد الذهاب يمين الشاشة.
    // الضغط على السهم الأيسر (<) يريد الذهاب يسار الشاشة.

    if (direction === "right") {
        container.scrollBy({ left: 300, behavior: "smooth" });
    } else {
        container.scrollBy({ left: -300, behavior: "smooth" });
    }
}
