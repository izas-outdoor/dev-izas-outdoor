
// SamplePg_VC++Dlg.h : header file
//

#pragma once
#include "afxwin.h"

//typedef void (*TEXTBOXCALLBACK)(CString data, int trackNumber);

class CSamplePg_VCDlg : public CDialog
{
// Construction
public:
	CSamplePg_VCDlg(CWnd* pParent = NULL);	// standard constructor

// Dialog Data
	enum { IDD = IDD_SAMPLEPG_VC_DIALOG };

	protected:
	virtual void DoDataExchange(CDataExchange* pDX);	// DDX/DDV support

	void EnableCtrls(BOOL bConnect);

// Implementation
protected:
	HICON m_hIcon;

	// Generated message map functions
	virtual BOOL OnInitDialog();
	afx_msg void OnPaint();
	afx_msg HCURSOR OnQueryDragIcon();
	DECLARE_MESSAGE_MAP()

protected:
	afx_msg void OnBnClickedConnect();
	afx_msg void OnBnClickedDisconnect();
	afx_msg void OnDestroy();
	afx_msg void OnBnClickedPrintReceipt();
	afx_msg void OnBnClickedCancel();

public:
	afx_msg void OnBnClickedGetStatus();
	afx_msg void OnBnRegisterCallbackFunction();
	afx_msg void OnBnUnRegisterCallbackFunction();

public:
	static int InterpretPrinterStatusData(int nStatus);
	static int CALLBACK StatusCallBackMethod(int nStatus);

private:
	CString m_strPrinterName;
public:
	virtual BOOL PreTranslateMessage(MSG* pMsg);
};
