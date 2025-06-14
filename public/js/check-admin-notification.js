// Function to fetch pending withdrawals
function getPendingWithdraw() {
    return fetch("/api/getPendingWithdraw").then((response) => response.json());
}

// Function to fetch pending deposits
function getPendingDeposit() {
    return fetch("/api/getPendingDeposit").then((response) => response.json());
}

// Function to check for pending documents in the verification_requests table
async function checkData() {
    try {
        const withdrawData = await getPendingWithdraw();
        const hasPendingWithdraw = withdrawData.some((record) => record.status === "pending");
        updatePendingWithdraw(hasPendingWithdraw);

        const depositData = await getPendingDeposit();
        const hasPendingDeposit = depositData.some((record) => record.status === "pending");
        updatePendingDeposit(hasPendingDeposit);

        updateNotificationIcon(hasPendingWithdraw || hasPendingDeposit);
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

// Function to update notification dot based on pending documents
function updateNotificationIcon(hasPendingDocuments) {
    const notificationDot = document.getElementById("notification-dot");
    notificationDot.style.display = hasPendingDocuments ? "block" : "none";
}

// Function to update display for pending withdrawals
function updatePendingWithdraw(hasPendingDocuments) {
    const withdrawElement = document.getElementById("isWithdraw");
    withdrawElement.style.display = hasPendingDocuments ? "block" : "none";
}

// Function to update display for pending deposits
function updatePendingDeposit(hasPendingDocuments) {
    const depositElement = document.getElementById("isDeposit");
    depositElement.style.display = hasPendingDocuments ? "block" : "none";
}

// Call the function to check pending documents when needed
checkData();
