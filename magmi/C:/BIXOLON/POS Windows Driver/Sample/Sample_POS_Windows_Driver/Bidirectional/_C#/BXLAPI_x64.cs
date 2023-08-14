using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using System.Runtime.InteropServices;

namespace SamplePg_CS
{
    class BXLAPI_x64
    {
        //
        [DllImport("BXLPStatusBack_x64.dll")]
        // Calls the specified printer to use Status API.
        public static extern bool BidiOpenMonPrinter(string szPrinterName);

        [DllImport("BXLPStatusBack_x64.dll")]
        // Calls the specified printer to use Status API.
        public static extern bool BidiOpenMonPrinterW([MarshalAs(UnmanagedType.LPWStr)]string szPrinterName);

        [DllImport("BXLPStatusBack_x64.dll")]
        // Closes Status API.
        public static extern bool BidiCloseMonPrinter();

        [DllImport("BXLPStatusBack_x64.dll")]
        public static extern bool BidiCancelCallBackFunction();

        [DllImport("BXLPStatusBack_x64.dll")]
        // Provides notification regarding the call of the callback function notifying the application when the ASB status of Status API changes.
        public static extern bool BidiSetStatusBackFunction(BXLAPI.BXLCallBackDelegate cbd);

        [DllImport("BXLPStatusBack_x64.dll")]
        public static extern bool BidiSetCallBackFunction(BXLAPI.BXLCallBackDelegate status, BXLAPI.BXLMsrCallBackDelegate msr);

        [DllImport("BXLPStatusBack_x64.dll")]
        // Cancels the auto status notification function. This function is applicable to BiSetStatusBackFunction,
        public static extern bool BidiCancelStatusBack();

        [DllImport("BXLPStatusBack_x64.dll")]
        // Acquires the ASB status from Status API when required by the application.
        public static extern int BidiGetStatus();

        //////////////////////////////////////////////////////////////////////
        //  Function List
        [DllImport("BXLPDC_x64.dll")]
        public static extern bool ConnectPrinter(string szPrinterName);
        [DllImport("BXLPDC_x64.dll")]
        public static extern bool ConnectPrinterW([MarshalAs(UnmanagedType.LPWStr)]string szPrinterName);
        [DllImport("BXLPDC_x64.dll")]
        public static extern void DisconnectPrinter();
        [DllImport("BXLPDC_x64.dll")]
        public static extern bool Start_Doc(string szDocName);
        [DllImport("BXLPDC_x64.dll")]
        public static extern bool Start_DocW([MarshalAs(UnmanagedType.LPWStr)]string szDocName);
        [DllImport("BXLPDC_x64.dll")]
        public static extern void End_Doc();
        [DllImport("BXLPDC_x64.dll")]
        public static extern bool Start_Page();
        [DllImport("BXLPDC_x64.dll")]
        public static extern void End_Page();
        [DllImport("BXLPDC_x64.dll")]
        public static extern int PrintDeviceFont(int nPositionX, int nPositionY, string szFontName, int nFontSize, string szData);
        [DllImport("BXLPDC_x64.dll")]
        public static extern int PrintDeviceFontW(int nPositionX, int nPositionY, [MarshalAs(UnmanagedType.LPWStr)]string szFontName, int nFontSize, [MarshalAs(UnmanagedType.LPWStr)]string szData);
        [DllImport("BXLPDC_x64.dll")]
        public static extern int PrintTrueFont(int nPositionX,
                                                int nPositionY,
                                                string szFontName,
                                                int nFontSize,
                                                string szData,
                                                bool bBold,
                                                int nRotation,
                                                bool bItalic,
                                                bool bUnderline);
        [DllImport("BXLPDC_x64.dll")]
        public static extern int PrintTrueFontW(int nPositionX,
                                                int nPositionY,
                                                [MarshalAs(UnmanagedType.LPWStr)]string szFontName,
                                                int nFontSize,
                                                [MarshalAs(UnmanagedType.LPWStr)]string szData,
                                                bool bBold,
                                                int nRotation,
                                                bool bItalic,
                                                bool bUnderline);
        [DllImport("BXLPDC_x64.dll")]
        public static extern int PrintBitmap(int nPositionX, int nPositionY, string bitmapFile);
        [DllImport("BXLPDC_x64.dll")]
        public static extern int PrintBitmapW(int nPositionX, int nPositionY, [MarshalAs(UnmanagedType.LPWStr)]string bitmapFile);
    }
}
