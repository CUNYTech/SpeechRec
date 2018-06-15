package com.example.kasinets.speechrecandroidapp;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.List;

public class VoicemailAdapter extends RecyclerView.Adapter<VoicemailAdapter.MyViewHolder> {

    private List<Voicemail> voicemailList;

    private Context mCtx;

    public VoicemailAdapter(Context mCtx, List<Voicemail> voicemailList) {
        this.mCtx = mCtx;
        this.voicemailList = voicemailList;
    }

    @Override
    public VoicemailAdapter.MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.voicemail_list_row, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(VoicemailAdapter.MyViewHolder holder, int position) {
        Voicemail voicemail = voicemailList.get(position);
        holder.username.setText(voicemail.getName());
        holder.message.setText(voicemail.getMessage());
        holder.date.setText(voicemail.getDate());
        holder.imageView.setImageDrawable(mCtx.getResources().getDrawable(voicemail.getImage()));
    }

    @Override
    public int getItemCount() {
        return voicemailList.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView username, message, date;
        public ImageView imageView;

        public MyViewHolder(View view) {
            super(view);
            username = (TextView) view.findViewById(R.id.lblName);
            message = (TextView) view.findViewById(R.id.lblMessage);
            date = (TextView) view.findViewById(R.id.lblDate);
            imageView = itemView.findViewById(R.id.imageView);
        }
    }
}
