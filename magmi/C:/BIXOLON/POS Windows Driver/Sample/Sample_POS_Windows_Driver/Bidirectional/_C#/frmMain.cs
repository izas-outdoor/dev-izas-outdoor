using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

using System.Diagnostics;
using System.Runtime.InteropServices;


namespace SamplePg_CS
{
    public partial class frmMain : Form
    {
        public enum PrinterStatus
        {
            PRN_STATUS_NORMAL               = 0,
            PRN_STATUS_OFFLINE              = 1,
            PRN_STATUS_PAPER_OUT            = 2,
            PRN_STATUS_NEAR_END_ERR         = 4,
            PRN_STATUS_DOOR_OPEN            = 8,
            PRN_STATUS_CASHDRAWER_OPEN      = 16,
            PRN_STATUS_AUTOCUTTER_ERR       = 32,
            PRN_STATUS_MECHANICAL_ERR       = 64,
            PRN_STATUS_UN_RECOVERABLE_ERR   = 128,
            PRN_STATUS_BATTERY_LOW          = 512,
        }

        private BXLAPI.BXLCallBackDelegate statusCallBackDelegate = null;

        public frmMain()
        {
            InitializeComponent();
        }

        private void frmMain_Load(object sender, EventArgs e)
        {
            
        }

        private void EnableCtrls(bool bConnect)
        {
            txtPrinterName.Enabled      = !bConnect;
            btnConnect.Enabled          = !bConnect;
            btnDisconnect.Enabled       = bConnect;
            btnPrint_Receipt.Enabled    = bConnect;
            btnStatus_Get.Enabled       = bConnect;
            btnStatus_Set.Enabled       = bConnect;
            btnStatus_Cancel.Enabled    = false;
        }

        private void btnConnectClick(object sender, EventArgs e)
        {
            if (BXLAPI.ConnectPrinter(txtPrinterName.Text.Trim()))
                EnableCtrls(true);
        }

        private void btnDisconnectClick(object sender, EventArgs e)
        {
            BXLAPI.DisconnectPrinter();
            BXLAPI.BidiCloseMonPrinter();
            statusCallBackDelegate = null;
            EnableCtrls(false);
        }

        private void btnPrintReceiptClick(object sender, EventArgs e)
        {
            int nPositionX  = 0;
            int nPositionY  = 0;
            int nTextHeight = 0;

            if (BXLAPI.Start_Doc("Print Receipt"))
            {
                BXLAPI.Start_Page();
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "x");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA2x2", 17, "* BIXOLON CAFE *");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Bundang-gu, Seongam-si");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Sampyeong-dong, 685");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Tel) 858-519-3698 Fax) 3852");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "w");
                nPositionY += nTextHeight * 2;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "------------------------------------------");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "ORANGE                              $3,500");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "BUFALO WING                         $3,000");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "POTATO                              $1,200");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "------------------------------------------");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Total                               $7,700");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Tax 6%                                $470");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Member Discount                       $900");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Money received                     $10,000");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Change                              $2,730");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "------------------------------------------");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "x");
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "Code128", 18, "123456789012");
                nPositionX = 80;
                nPositionY += nTextHeight / 2;
                nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "Member Number : 452331949", false, 0, true, false);
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "HAVE A NICE DAY!", false, 0, true, false);
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "Sale Date: 07/01/03", false, 0, true, false);
                nPositionY += nTextHeight;
                nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "Time: 12:30:45", false, 0, true, false);
                nPositionX = 150;
                nPositionY += nTextHeight * 2;
                nTextHeight = BXLAPI.PrintBitmap(nPositionX, nPositionY, ".\\free.bmp");
                BXLAPI.End_Page();	// End Page
                BXLAPI.End_Doc();	// End Document
            }
        }

        private void btnExitClick(object sender, EventArgs e)
        {
            BXLAPI.DisconnectPrinter();
            BXLAPI.BidiCloseMonPrinter();
            this.Close();
        }

        public static int interpretPrinterStatusData(int status)
        {
            if (status == (int)PrinterStatus.PRN_STATUS_NORMAL)
            {
                MessageBox.Show("PRN_STATUS_NORMAL", "STATUS");
                return (int)PrinterStatus.PRN_STATUS_NORMAL;
            }

            if (((int)PrinterStatus.PRN_STATUS_OFFLINE & status) != 0)                  MessageBox.Show("PRN_STATUS_OFFLINE", "STATUS");
            if (((int)PrinterStatus.PRN_STATUS_DOOR_OPEN & status) != 0)                MessageBox.Show("PRN_STATUS_DOOR_OPEN", "STATUS");
            if (((int)PrinterStatus.PRN_STATUS_CASHDRAWER_OPEN & status) != 0)          MessageBox.Show("PRN_STATUS_CASHDRAWER_OPEN", "STATUS");

            if (((int)PrinterStatus.PRN_STATUS_BATTERY_LOW & status) != 0)              MessageBox.Show("PRN_STATUS_BATTERY_LOW", "STATUS");
            else if (((int)PrinterStatus.PRN_STATUS_MECHANICAL_ERR & status) != 0)      MessageBox.Show("PRN_STATUS_MECHANICAL_ERR", "STATUS");
            else if (((int)PrinterStatus.PRN_STATUS_AUTOCUTTER_ERR & status) != 0)      MessageBox.Show("PRN_STATUS_AUTOCUTTER_ERR", "STATUS");
            else if (((int)PrinterStatus.PRN_STATUS_UN_RECOVERABLE_ERR & status) != 0)  MessageBox.Show("PRN_STATUS_UN_RECOVERABLE_ERR", "STATUS");

            if (((int)PrinterStatus.PRN_STATUS_NEAR_END_ERR & status) != 0)             MessageBox.Show("PRN_STATUS_NEAR_END_ERR", "STATUS");
            else if (((int)PrinterStatus.PRN_STATUS_PAPER_OUT & status) != 0)           MessageBox.Show("PRN_STATUS_PAPER_OUT", "STATUS");

            return status;
        }

        public static int statusCallBackMethod(int nStatus)
        {
            return interpretPrinterStatusData(nStatus);
        }

        private void btnGetStatusClick(object sender, EventArgs e)
        {
            if (BXLAPI.BidiOpenMonPrinter(txtPrinterName.Text.Trim()))
            {
                interpretPrinterStatusData(BXLAPI.BidiGetStatus());
                BXLAPI.BidiCloseMonPrinter();
            }
            else{
                MessageBox.Show("BidiOpenMonPrinter failed");
            }
        }

        private void btnRegisterCallbackFunction(object sender, EventArgs e)
        {
            if (BXLAPI.BidiOpenMonPrinter(txtPrinterName.Text.Trim()))
            {
                statusCallBackDelegate = new BXLAPI.BXLCallBackDelegate(statusCallBackMethod);
                //BXLAPI.BidiSetStatusBackFunction(statusCallBackDelegate);
                BXLAPI.BidiSetCallBackFunction(statusCallBackDelegate, null);
                btnStatus_Get.Enabled       = false;
                btnStatus_Set.Enabled       = false;
                btnStatus_Cancel.Enabled    = true;
            }
            else
            {
                MessageBox.Show("BidiOpenMonPrinter failed");
            }
        }

        private void btnUnRegisterCallbackFunction(object sender, EventArgs e)
        {
            BXLAPI.BidiCancelCallBackFunction();
            statusCallBackDelegate      = null;
            btnStatus_Get.Enabled       = true;
            btnStatus_Set.Enabled       = true;
            btnStatus_Cancel.Enabled    = false;
        }
    }
}
