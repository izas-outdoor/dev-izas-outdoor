
// SamplePg_VC++Dlg.cpp : implementation file
//

#include "stdafx.h"
#include "SamplePg_VC++.h"
#include "SamplePg_VC++Dlg.h"
#include ".\\Inc\\BXLPDcApi.h"

#ifdef TARGET_64BIT
#pragma comment(lib, ".\\Lib\\BXLPDC_x64.lib")
#else
#pragma comment(lib, ".\\Lib\\BXLPDC.lib")
#endif

#include ".\\Inc\\BXLPStatusBackApi.h"

#ifdef TARGET_64BIT
#pragma comment(lib, ".\\Lib\\BXLPStatusBack_x64.lib")
#else
#pragma comment(lib, ".\\Lib\\BXLPStatusBack.lib")
#endif


#ifdef _DEBUG
#define new DEBUG_NEW
#endif

#define WM_MSR_EVENT WM_USER + 1

BEGIN_MESSAGE_MAP(CSamplePg_VCDlg, CDialog)
	ON_WM_PAINT()
	ON_WM_QUERYDRAGICON()
	//}}AFX_MSG_MAP
	ON_BN_CLICKED(IDC_CONNECT, &CSamplePg_VCDlg::OnBnClickedConnect)
	ON_BN_CLICKED(IDC_DISCONNECT, &CSamplePg_VCDlg::OnBnClickedDisconnect)
	ON_WM_DESTROY()
	ON_BN_CLICKED(IDC_PRINT_RECEIPT, &CSamplePg_VCDlg::OnBnClickedPrintReceipt)
	ON_BN_CLICKED(IDCANCEL, &CSamplePg_VCDlg::OnBnClickedCancel)
	ON_BN_CLICKED(IDC_STATUS_GET, &CSamplePg_VCDlg::OnBnClickedGetStatus)
	ON_BN_CLICKED(IDC_STATUS_SET, &CSamplePg_VCDlg::OnBnRegisterCallbackFunction)
	ON_BN_CLICKED(IDC_STATUS_CANCEL, &CSamplePg_VCDlg::OnBnUnRegisterCallbackFunction)
END_MESSAGE_MAP()

//void FillTextBox(CString data, int trackNumber);

static CSamplePg_VCDlg* pDlg;

CSamplePg_VCDlg::CSamplePg_VCDlg(CWnd* pParent /*=NULL*/)
	: CDialog(CSamplePg_VCDlg::IDD, pParent)
	, m_strPrinterName(_T(""))
{
	m_hIcon = AfxGetApp()->LoadIcon(IDR_MAINFRAME);
}

void CSamplePg_VCDlg::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_EDIT_PRINTERNAME, m_strPrinterName);
}

// CSamplePg_VCDlg message handlers

BOOL CSamplePg_VCDlg::OnInitDialog()
{
	CDialog::OnInitDialog();

	// Set the icon for this dialog.  The framework does this automatically
	//  when the application's main window is not a dialog
	SetIcon(m_hIcon, TRUE);			// Set big icon
	SetIcon(m_hIcon, FALSE);		// Set small icon

	// TODO: Add extra initialization here
	m_strPrinterName = "BIXOLON SRP-350III";
	pDlg = this;
	UpdateData(FALSE);
	return TRUE;  // return TRUE  unless you set the focus to a control
}

void CSamplePg_VCDlg::OnDestroy()
{
	DisconnectPrinter();
	BidiCloseMonPrinter();
	CDialog::OnDestroy();
}

// If you add a minimize button to your dialog, you will need the code below
//  to draw the icon.  For MFC applications using the document/view model,
//  this is automatically done for you by the framework.

void CSamplePg_VCDlg::OnPaint()
{
	if (IsIconic())
	{
		CPaintDC dc(this); // device context for painting

		SendMessage(WM_ICONERASEBKGND, reinterpret_cast<WPARAM>(dc.GetSafeHdc()), 0);

		// Center icon in client rectangle
		int cxIcon = GetSystemMetrics(SM_CXICON);
		int cyIcon = GetSystemMetrics(SM_CYICON);
		CRect rect;
		GetClientRect(&rect);
		int x = (rect.Width() - cxIcon + 1) / 2;
		int y = (rect.Height() - cyIcon + 1) / 2;

		// Draw the icon
		dc.DrawIcon(x, y, m_hIcon);
	}
	else
	{
		CDialog::OnPaint();
	}
}

// The system calls this function to obtain the cursor to display while the user drags
//  the minimized window.
HCURSOR CSamplePg_VCDlg::OnQueryDragIcon()
{
	return static_cast<HCURSOR>(m_hIcon);
}

void CSamplePg_VCDlg::OnBnClickedConnect()
{
	UpdateData(TRUE);
	if(ConnectPrinterW(m_strPrinterName.GetBuffer(m_strPrinterName.GetLength())))
		EnableCtrls(TRUE);	
}

void CSamplePg_VCDlg::OnBnClickedDisconnect()
{
	//BeginWaitCursor();
	DisconnectPrinter();
	BidiCloseMonPrinter();
	EnableCtrls(FALSE);	
	//EndWaitCursor();
}

void CSamplePg_VCDlg::OnBnClickedCancel()
{
	OnCancel();
}

void CSamplePg_VCDlg::OnBnClickedPrintReceipt()
{
	int			nPositionX	= 0;	
	int			nPositionY	= 0;
	int			nTextHeight	= 0;
	CString		strBuffer	= TEXT("");

	UpdateData(TRUE);

	if( Start_DocW(TEXT("Print Receipt"))) 
	{
		Start_Page();
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontControl"), 8, TEXT("x"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA2x2"), 17, TEXT("* BIXOLON CAFE *"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Bundang-gu, Seongam-si"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Sampyeong-dong, 685"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Tel) 858-519-3698 Fax) 3852"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontControl"), 8, TEXT("w"));
		nPositionY += nTextHeight*2;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("------------------------------------------"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("ORANGE                              $3,500"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("BUFALO WING                         $3,000"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("POTATO                              $1,200"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("------------------------------------------"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Total                               $7,700"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Tax 6%                                $470"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Member Discount                       $900"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Money received                     $10,000"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("Change                              $2,730"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontA1x1"), 8, TEXT("------------------------------------------"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("FontControl"), 8, TEXT("x"));
		nPositionY += nTextHeight;
		nTextHeight = PrintDeviceFontW(nPositionX, nPositionY, TEXT("Code128"), 18, TEXT("123456789012"));
		nPositionX  = 80;
		nPositionY += nTextHeight;
		nTextHeight = PrintTrueFontW(nPositionX, nPositionY, TEXT("Arial"), 10, TEXT("Member Number : 452331949"), FALSE, 0, TRUE);
		nPositionY += nTextHeight;
		nTextHeight = PrintTrueFontW(nPositionX, nPositionY, TEXT("Arial"), 10, TEXT("HAVE A NICE DAY!"), FALSE, 0, TRUE);
		nPositionY += nTextHeight;
		nTextHeight = PrintTrueFontW(nPositionX, nPositionY, TEXT("Arial"), 10, TEXT("Sale Date: 07/01/03"), FALSE, 0, TRUE);
		nPositionY += nTextHeight;
		nTextHeight = PrintTrueFontW(nPositionX, nPositionY, TEXT("Arial"), 10, TEXT("Time: 12:30:45"), FALSE, 0, TRUE);
		nPositionX  = 150;
		nPositionY += nTextHeight*2;
		nTextHeight = PrintBitmapW(nPositionX, nPositionY, TEXT(".\\free.bmp"));
		End_Page();
		End_Doc();
	}
}

void CSamplePg_VCDlg::OnBnClickedGetStatus()
{
	UpdateData(TRUE);
	if(BidiOpenMonPrinterW(m_strPrinterName.GetBuffer(m_strPrinterName.GetLength()))){
		InterpretPrinterStatusData(BidiGetStatus());
		BidiCloseMonPrinter();
	}
	else{
		AfxMessageBox(TEXT("BidiOpenMonPrinterW failed"));
	}
}

void CSamplePg_VCDlg::OnBnRegisterCallbackFunction()
{
	if(BidiOpenMonPrinterW(m_strPrinterName.GetBuffer(m_strPrinterName.GetLength()))){
		//BidiSetStatusBackFunction(statusCallBackMethod);
		BidiSetCallBackFunction(&CSamplePg_VCDlg::StatusCallBackMethod, NULL);
		GetDlgItem(IDC_STATUS_GET)->EnableWindow(FALSE);
		GetDlgItem(IDC_STATUS_SET)->EnableWindow(FALSE);
		GetDlgItem(IDC_STATUS_CANCEL)->EnableWindow(TRUE);
	}
	else{
		AfxMessageBox(TEXT("BidiOpenMonPrinterW failed"));
	}
}

void CSamplePg_VCDlg::OnBnUnRegisterCallbackFunction()
{
	BidiCancelCallBackFunction();
	GetDlgItem(IDC_STATUS_GET)->EnableWindow(TRUE);
	GetDlgItem(IDC_STATUS_SET)->EnableWindow(TRUE);
	GetDlgItem(IDC_STATUS_CANCEL)->EnableWindow(FALSE);
}

void CSamplePg_VCDlg::EnableCtrls(BOOL bConnect)
{
	GetDlgItem(IDC_CONNECT)->EnableWindow(!bConnect);
	GetDlgItem(IDC_EDIT_PRINTERNAME)->EnableWindow(!bConnect);
	GetDlgItem(IDC_DISCONNECT)->EnableWindow(bConnect);
	GetDlgItem(IDC_PRINT_RECEIPT)->EnableWindow(bConnect);
	GetDlgItem(IDC_STATUS_GET)->EnableWindow(bConnect);
	GetDlgItem(IDC_STATUS_SET)->EnableWindow(bConnect);
	GetDlgItem(IDC_STATUS_CANCEL)->EnableWindow(FALSE);

	UpdateData(FALSE);
}

int CSamplePg_VCDlg::InterpretPrinterStatusData(int statusData)
{
	const int PRN_STATUS_NORMAL					= 0;
	const int PRN_STATUS_OFFLINE				= 1;
	const int PRN_STATUS_PAPER_OUT				= 2;
	const int PRN_STATUS_NEAR_END_ERR			= 4;
	const int PRN_STATUS_DOOR_OPEN				= 8;
	const int PRN_STATUS_CASHDRAWER_OPEN		= 16;
	const int PRN_STATUS_AUTOCUTTER_ERR			= 32;
	const int PRN_STATUS_MECHANICAL_ERR			= 64;
	const int PRN_STATUS_UN_RECOVERABLE_ERR		= 128;
	const int PRN_STATUS_BATTERY_LOW			= 512;

	if (statusData == PRN_STATUS_NORMAL){
		AfxMessageBox(TEXT("PRN_STATUS_NORMAL"), MB_OK | MB_ICONINFORMATION);
		return PRN_STATUS_NORMAL;
	}

	if ((PRN_STATUS_OFFLINE & statusData) != 0)					AfxMessageBox(TEXT("PRN_STATUS_OFFLINE"), MB_OK);
	if ((PRN_STATUS_DOOR_OPEN & statusData) != 0)				AfxMessageBox(TEXT("PRN_STATUS_DOOR_OPEN"), MB_OK);
	if ((PRN_STATUS_CASHDRAWER_OPEN & statusData) != 0)			AfxMessageBox(TEXT("PRN_STATUS_CASHDRAWER_OPEN"), MB_OK);

	if ((PRN_STATUS_BATTERY_LOW & statusData) != 0)				AfxMessageBox(TEXT("PRN_STATUS_BATTERY_LOW"), MB_OK);
	else if ((PRN_STATUS_MECHANICAL_ERR & statusData) != 0)		AfxMessageBox(TEXT("PRN_STATUS_MECHANICAL_ERR"), MB_OK);
	else if ((PRN_STATUS_AUTOCUTTER_ERR & statusData) != 0)		AfxMessageBox(TEXT("PRN_STATUS_AUTOCUTTER_ERR"), MB_OK);
	else if ((PRN_STATUS_UN_RECOVERABLE_ERR & statusData) != 0)	AfxMessageBox(TEXT("PRN_STATUS_UN_RECOVERABLE_ERR"), MB_OK);

	if ((PRN_STATUS_NEAR_END_ERR & statusData) != 0)			AfxMessageBox(TEXT("PRN_STATUS_NEAR_END_ERR"), MB_OK);
	else if ((PRN_STATUS_PAPER_OUT & statusData) != 0)			AfxMessageBox(TEXT("PRN_STATUS_PAPER_OUT"), MB_OK);

	return statusData;
}

int CALLBACK CSamplePg_VCDlg::StatusCallBackMethod(int statusData)
{
	return InterpretPrinterStatusData(statusData);
}

BOOL CSamplePg_VCDlg::PreTranslateMessage(MSG* pMsg)
{
	return CDialog::PreTranslateMessage(pMsg);
}
