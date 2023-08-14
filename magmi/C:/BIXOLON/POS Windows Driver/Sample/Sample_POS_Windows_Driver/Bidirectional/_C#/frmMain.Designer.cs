namespace SamplePg_CS
{
    partial class frmMain
    {
        /// <summary>
        /// 필수 디자이너 변수입니다.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// 사용 중인 모든 리소스를 정리합니다.
        /// </summary>
        /// <param name="disposing">관리되는 리소스를 삭제해야 하면 true이고, 그렇지 않으면 false입니다.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form 디자이너에서 생성한 코드

        /// <summary>
        /// 디자이너 지원에 필요한 메서드입니다.
        /// 이 메서드의 내용을 코드 편집기로 수정하지 마십시오.
        /// </summary>
        private void InitializeComponent()
        {
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.btnConnect = new System.Windows.Forms.Button();
            this.btnDisconnect = new System.Windows.Forms.Button();
            this.txtPrinterName = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.groupBox4 = new System.Windows.Forms.GroupBox();
            this.btnPrint_Receipt = new System.Windows.Forms.Button();
            this.btnExit = new System.Windows.Forms.Button();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.btnStatus_Cancel = new System.Windows.Forms.Button();
            this.btnStatus_Set = new System.Windows.Forms.Button();
            this.btnStatus_Get = new System.Windows.Forms.Button();
            this.groupBox3 = new System.Windows.Forms.GroupBox();
            this.groupBox1.SuspendLayout();
            this.groupBox4.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.groupBox3.SuspendLayout();
            this.SuspendLayout();
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.btnConnect);
            this.groupBox1.Controls.Add(this.btnDisconnect);
            this.groupBox1.Controls.Add(this.txtPrinterName);
            this.groupBox1.Controls.Add(this.label1);
            this.groupBox1.Location = new System.Drawing.Point(8, 14);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(392, 86);
            this.groupBox1.TabIndex = 0;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Connection";
            // 
            // btnConnect
            // 
            this.btnConnect.Location = new System.Drawing.Point(17, 45);
            this.btnConnect.Name = "btnConnect";
            this.btnConnect.Size = new System.Drawing.Size(176, 32);
            this.btnConnect.TabIndex = 2;
            this.btnConnect.Text = "Connect Printer";
            this.btnConnect.UseVisualStyleBackColor = true;
            this.btnConnect.Click += new System.EventHandler(this.btnConnectClick);
            // 
            // btnDisconnect
            // 
            this.btnDisconnect.Enabled = false;
            this.btnDisconnect.Location = new System.Drawing.Point(207, 45);
            this.btnDisconnect.Name = "btnDisconnect";
            this.btnDisconnect.Size = new System.Drawing.Size(176, 32);
            this.btnDisconnect.TabIndex = 2;
            this.btnDisconnect.Text = "Disconnect Printer";
            this.btnDisconnect.UseVisualStyleBackColor = true;
            this.btnDisconnect.Click += new System.EventHandler(this.btnDisconnectClick);
            // 
            // txtPrinterName
            // 
            this.txtPrinterName.Location = new System.Drawing.Point(131, 19);
            this.txtPrinterName.Name = "txtPrinterName";
            this.txtPrinterName.Size = new System.Drawing.Size(252, 21);
            this.txtPrinterName.TabIndex = 1;
            this.txtPrinterName.Text = "BIXOLON SRP-350III";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(17, 22);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(102, 15);
            this.label1.TabIndex = 0;
            this.label1.Text = "PRINTER NAME :";
            // 
            // groupBox4
            // 
            this.groupBox4.Controls.Add(this.btnPrint_Receipt);
            this.groupBox4.Location = new System.Drawing.Point(8, 106);
            this.groupBox4.Name = "groupBox4";
            this.groupBox4.Size = new System.Drawing.Size(392, 60);
            this.groupBox4.TabIndex = 3;
            this.groupBox4.TabStop = false;
            this.groupBox4.Text = "Print Receipt";
            // 
            // btnPrint_Receipt
            // 
            this.btnPrint_Receipt.Enabled = false;
            this.btnPrint_Receipt.Location = new System.Drawing.Point(15, 16);
            this.btnPrint_Receipt.Name = "btnPrint_Receipt";
            this.btnPrint_Receipt.Size = new System.Drawing.Size(176, 32);
            this.btnPrint_Receipt.TabIndex = 0;
            this.btnPrint_Receipt.Text = "Receipt";
            this.btnPrint_Receipt.UseVisualStyleBackColor = true;
            this.btnPrint_Receipt.Click += new System.EventHandler(this.btnPrintReceiptClick);
            // 
            // btnExit
            // 
            this.btnExit.Location = new System.Drawing.Point(215, 307);
            this.btnExit.Name = "btnExit";
            this.btnExit.Size = new System.Drawing.Size(176, 32);
            this.btnExit.TabIndex = 4;
            this.btnExit.Text = "Exit";
            this.btnExit.UseVisualStyleBackColor = true;
            this.btnExit.Click += new System.EventHandler(this.btnExitClick);
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.btnStatus_Cancel);
            this.groupBox2.Controls.Add(this.btnStatus_Set);
            this.groupBox2.Location = new System.Drawing.Point(8, 241);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(392, 60);
            this.groupBox2.TabIndex = 5;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Register Callback (Printer Status)";
            // 
            // btnStatus_Cancel
            // 
            this.btnStatus_Cancel.Location = new System.Drawing.Point(207, 21);
            this.btnStatus_Cancel.Name = "btnStatus_Cancel";
            this.btnStatus_Cancel.Size = new System.Drawing.Size(176, 32);
            this.btnStatus_Cancel.TabIndex = 0;
            this.btnStatus_Cancel.Text = "Unregister Callback";
            this.btnStatus_Cancel.UseVisualStyleBackColor = true;
            this.btnStatus_Cancel.Click += new System.EventHandler(this.btnUnRegisterCallbackFunction);
            // 
            // btnStatus_Set
            // 
            this.btnStatus_Set.Location = new System.Drawing.Point(15, 21);
            this.btnStatus_Set.Name = "btnStatus_Set";
            this.btnStatus_Set.Size = new System.Drawing.Size(176, 32);
            this.btnStatus_Set.TabIndex = 0;
            this.btnStatus_Set.Text = "Register Callback";
            this.btnStatus_Set.UseVisualStyleBackColor = true;
            this.btnStatus_Set.Click += new System.EventHandler(this.btnRegisterCallbackFunction);
            // 
            // btnStatus_Get
            // 
            this.btnStatus_Get.Location = new System.Drawing.Point(15, 16);
            this.btnStatus_Get.Name = "btnStatus_Get";
            this.btnStatus_Get.Size = new System.Drawing.Size(176, 32);
            this.btnStatus_Get.TabIndex = 0;
            this.btnStatus_Get.Text = "Get Printer-Status";
            this.btnStatus_Get.UseVisualStyleBackColor = true;
            this.btnStatus_Get.Click += new System.EventHandler(this.btnGetStatusClick);
            // 
            // groupBox3
            // 
            this.groupBox3.Controls.Add(this.btnStatus_Get);
            this.groupBox3.Location = new System.Drawing.Point(8, 175);
            this.groupBox3.Name = "groupBox3";
            this.groupBox3.Size = new System.Drawing.Size(392, 60);
            this.groupBox3.TabIndex = 4;
            this.groupBox3.TabStop = false;
            this.groupBox3.Text = "Get Printer Status";
            // 
            // frmMain
            // 
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.None;
            this.ClientSize = new System.Drawing.Size(410, 347);
            this.Controls.Add(this.groupBox3);
            this.Controls.Add(this.groupBox2);
            this.Controls.Add(this.btnExit);
            this.Controls.Add(this.groupBox4);
            this.Controls.Add(this.groupBox1);
            this.Font = new System.Drawing.Font("Arial", 9F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
            this.Name = "frmMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Sample";
            this.Load += new System.EventHandler(this.frmMain_Load);
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.groupBox4.ResumeLayout(false);
            this.groupBox2.ResumeLayout(false);
            this.groupBox3.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button btnConnect;
        private System.Windows.Forms.Button btnDisconnect;
        private System.Windows.Forms.TextBox txtPrinterName;
        private System.Windows.Forms.GroupBox groupBox4;
        private System.Windows.Forms.Button btnPrint_Receipt;
        private System.Windows.Forms.Button btnExit;
        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.Button btnStatus_Cancel;
        private System.Windows.Forms.Button btnStatus_Set;
        private System.Windows.Forms.Button btnStatus_Get;
        private System.Windows.Forms.GroupBox groupBox3;
    }
}

