export function showToast(message) {
    const toast = document.createElement("div");

    toast.innerText = message;

    Object.assign(toast.style, {
        position: "fixed",
        bottom: "30px",
        right: "30px",
        background: "#28a745",
        color: "#fff",
        padding: "12px 18px",
        borderRadius: "6px",
        zIndex: "99999",
        boxShadow: "0 5px 15px rgba(0,0,0,0.2)",
        fontSize: "14px",
    });

    document.body.appendChild(toast);

    setTimeout(() => toast.remove(), 2500);
}
